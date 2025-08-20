<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //PRODUCT

    //All Products
    public function showAllproducts()
    {
        $products = Product::all();
        return view('moon.allproducts', compact('products'));
    }



    //Detail Product
    public function showDetailproduct($id)
    {
        $product = Product::findOrFail($id);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->limit(2)
            ->get();
        return view('moon.detailproduct', compact('product', 'relatedProducts'));
    }



    //CART

    //Add to Cart
    public function saveToCart($id, Request $request)
    {
        if (Auth::check()) {
            $data['user_id'] = Auth::user()->id;
            $data['product_id'] = $id;
            $data['qty'] = 1;
            $cart = Cart::create($data);
            if ($cart)
                return back()->with('success', 'Added to Cart!');
            else
                return back()->withErrors('errors', 'failed to add');
        }
        return redirect('/moon/signin')->withErrors(['You need to sign in first to add items!']);
    }

    //Cart items count
    public static function countItem()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            return Cart::where('user_id', $user_id)->count();
        }
    }

    //Cart items remove
    public function CartItemRemove($id)
    {
        Cart::destroy($id);
        return redirect()->back()->with('success', 'It has been removed successfully');
    }




    //WISHLIST

    //Add to wishlist
    public function saveToWishlist($id, Request $request)
    {
        if (Auth::check()) {
            $data['user_id'] = Auth::user()->id;
            $data['product_id'] = $id;
            $data['qty'] = 1;
            $wishlist = Wishlist::create($data);
            if ($wishlist)
                return back()->with('success', 'Added to Wishlist!');
            else
                return back()->withErrors('errors', 'failed to add');
        }
        return redirect('/moon/signin')->withErrors(['You need to sign in first to add items']);
    }

    //wishlist items count
    public static function wishlistCountItem()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            return Wishlist::where('user_id', $user_id)->count();
        }
    }

    //wishlist items remove
    public function wishlistItemRemove($id)
    {
        Wishlist::destroy($id);
        return redirect()->back()->with('success', 'It has been removed successfully');
    }



    //ORDER

    //OrderDetails
    public function orderDetail(Request $request)
    {
        $user_id = Auth::user()->id;
        $username = Auth::user()->name;
        $cartItems = Cart::where('user_id', $user_id)->with('product')
            ->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->qty);
        return view('moon.orderDetail', ['total' => $total, 'uname' => $username, 'cartItems' => $cartItems]);
    }

    //place order
    public function placeOrder(Request $request)
    {
        $order = Order::create([
            'user_id' => Auth::id(),
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $request->total,
            'payment' => $request->payment,
            'order_status' => 'pending'
        ]);
        //Insert into order_details
        $cartItems = Cart::where('user_id', Auth::id())
            ->get();
        foreach ($cartItems as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->qty
            ]);
        }
        //Clear Cart
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->route('get_current')->with('success','Placed order successfully!');
    }

    //Order list
    public function getCurrent()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderDetails.product')
            ->orderBy('created_at','desc')
            ->get();
        return view('moon.currentOrder', compact('orders'));
    }



    //Category
    public function showCategory($categoryName)
    {
        $category = Category::where('name', $categoryName)->first();

        $products = Product::where('category_id', $category->id)->get();

        return view('moon.category', ['products' => $products, 'category' => $categoryName]);
    }

    public function getGiftJewelryDropdown()
{
    $categoryNames = ['Bracelets', 'Rings', 'Necklaces', 'Engagement Rings', 'Earrings', 'Brooches'];

    $dropdownItems = [];

    foreach ($categoryNames as $name) {
        $category = Category::where('name', $name)->first();

        if ($category) {
            $product = Product::where('category_id', $category->id)->inRandomOrder()->first();

            $dropdownItems[] = [
                'name' => $category->name,
                'slug' => $category->name,
                'image' => $product->image,
            ];
        }
    }

    return $dropdownItems;
}

public function getSingleCategoryDropdown($categoryName)
{
    $category = Category::where('name', $categoryName)->first();

    if ($category) {
        $products = Product::where('category_id', $category->id)
                           ->inRandomOrder()
                           ->limit(5)
                           ->get();

        return [
            'category_name' => $category->name,
            'category_slug' => $category->name,
            'products' => $products
        ];
    }

    return null;
}

    //search
    public function searchProducts(Request $request)
    {
        $search = $request->search;
        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
                            ->where('products.name', 'LIKE', "%{$search}%")
                            ->orWhere('categories.name', 'LIKE', "%{$search}%")
                            ->select('products.*')
                           ->get();
                           if($products->isEmpty()){
                            $result = Product::all();
                            return redirect()->route('showallproducts')->with(['products'=>$result,'success'=>'No products found matching your search. Showing all products instead.']);
                           
                           }
        return view('moon.allproducts', ['products' => $products]);
        
    }
}

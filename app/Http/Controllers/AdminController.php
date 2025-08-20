<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Appointment;
use App\Models\CarouselImage;
use App\Models\BannerImage;
use App\Models\ProductsWithModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// use Illuminate\Contracts\Session\Session;

class AdminController extends Controller
{

    //LOGIN 
    public function index()
    {
        return view('admin.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $admin = Admin::where(['email' => $request->email])->count();
        if ($admin) {
            $result = $request->only('email', 'password');
            if (auth('admin')->attempt($result))
                return redirect()->route('admin_dashboard');
        }
        return back()->withErrors(['errors' => 'Invalid email or password']);
    }



    //dashboard
    public function dashboard()
    {
        $users = User::count();
        $orders = Order::count();
        $products = Product::count();
        $messages = Contact::count();
        $appointments = Appointment::count();

        $salesByDays = Order::select(
            DB::raw('Month(created_at) as month'),
            DB::raw('Count(*) as total')
        )
            ->whereYear('created_at', now()->year)
            ->where('order_status', 'complete')
            ->groupBy('month')
            ->get();

        //prepareing data for chart
        $sale_days = $salesByDays->pluck('month');
        $sale_total = $salesByDays->pluck('total');

        $ordersByDays = Order::select(
            DB::raw('day(created_at)as day'),
            DB::raw('Count(*) as total')
        )
            ->whereYear('created_at', now()->year)
            ->where('order_status', 'pending')
            ->groupBy('day')
            ->get();

        $order_days = $ordersByDays->pluck('day');
        $order_total = $ordersByDays->pluck('total');
        return view('admin.include.dashboard', ['users' => $users, 'orders' => $orders, 'products' => $products, 'messages' => $messages, 'appointments' => $appointments, 'saleDays' => $sale_days, 'saleTotal' => $sale_total, 'orderDays' => $order_days, 'orderTotal' => $order_total, 'title' => 'Dashboard']);
    }



    //order
    public function order()
    {
        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('order_status', 'pending')
            ->select('users.name as username', 'orders.id as oid', 'orders.*', 'orders.created_at as order_date', 'products.*', 'order_details.*')
            ->get();
        return view('admin.include.order', ['orders' => $orders, 'title' => 'Orders']);
    }
    public function changeStatus($oid)
    {
        Order::where('id', $oid)->Update(['order_status' => 'completed']);
        return back();
    }



    //PRODUCT
    public function product(Request $request)
    {
        $query = Product::query();
    
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
    
        $products = $query->paginate(8);
        $categories = Category::all();
    
        return view('admin.include.product', [
            'products' => $products,
            'categories' => $categories,
            'title' => 'Products'
        ]);
    }
    
    //productDelete
    public function productDelete($pid)
    {
        Product::where('id', $pid)->delete();
        return back()->with('success', 'Product deleted successfully!');
    }
    //productEdit
    public function productEdit($pid)
    {
        $product = Product::where('id', $pid)->get();
        return view('admin.include.productEdit', ['product' => $product, 'title' => 'Product Edit']);
    }
    //productUpdate
    public function productUpdate($pid, Request $request)
    {
        $Data = [
            'name' => $request->name,
            'price' => $request->price,
            'metal' => $request->metal,
            'description' => $request->description
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $Data['image'] = 'images/' . $filename;
        }
        Product::where('id', $pid)->update($Data);
        return redirect('/admin/product')->with('success', 'Product updated successfully!');
    }

  



    //Add new Product
    public function newproduct()
    {
        $categories = Category::all();
        return view('admin.include.newproduct', compact('categories') + ['title' => 'Add Products']);
    }
    public function addProduct(Request $request)
    {
        $data = new Product();
        $data->category_id = $request->category;
        $data->name = $request->name;
        $data->price = $request->price;
        $data->metal = $request->metal;
        $data->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $request->image->move(public_path('images'), $filename);
            $data->image = 'images/' . $filename;
        }
        $data->save();
        return redirect('/admin/product')->with('success', 'Product added successfully!');
    }



    //customers
    public function customer()
    {
        $users = User::paginate(6);
        return view('admin.include.customer', ['customers' => $users, 'title' => 'Customers']);
    }

    //Customer Order History
    public function customerHistory($id)
    {
        $customer = User::findOrFail($id);
        $orders = Order::where('user_id', $id)->get();
        $totalSpent = Order::where('user_id', $id)->sum('total');
        $totalOrders = Order::where('user_id', $id)->count();

        return view('admin.include.customerHistory', compact('customer', 'totalSpent', 'orders', 'totalOrders') + ['title' => 'Customers']);
    }


    //sales
    public function sale()
    {
        $sales = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('order_status', 'completed')
            ->select(
                'users.name as username',
                'orders.id as oid',
                'orders.updated_at as sale_date',
                'orders.*',
                'products.*',
                'order_details.*',
                'categories.name as category_name'
            )
            ->get();
            $totalSales = $sales->count();
            $totalEarnings = $sales->sum('price');

        return view('admin.include.sale', ['sales' => $sales,'totalSales'=>$totalSales,'totalEarnings'=>$totalEarnings, 'title' => 'Sales']);
    }



    //message
    public function message()
    {
        $msg = Contact::join('users', 'contacts.user_id', '=', 'users.id')
            ->select('users.name', 'users.email', 'contacts.*')
            ->get();
        return view('admin.include.message', ['message' => $msg, 'title' => 'Messages']);
    }
    public function deleteMessage($id)
    {
        Contact::where('id', $id)->delete();
        return redirect()->route('admin_message')->with(['success'=>'Message has been deleted']);
    }

    //Appointment
    public function bookMessage()
    {
        $msg = Appointment::join('users', 'appointments.user_id', '=', 'users.id')
            ->select('users.name', 'users.email', 'appointments.*')
            ->get();
        return view('admin.include.bookedmessage', ['bookMsg' => $msg, 'title' => 'Appointments']);
    }
    public function deleteAppointments($id)
    {
        Appointment::where('id', $id)->delete();
        return redirect()->route('admin_bookMessage')->with(['success'=>'Appointment has been deleted ']);
    }



    //admin account create
    public function createaccount()
    {
        return view('admin.include.createaccount', ['title' => 'Accounts']);
    }
    public function AddAccount(Request $request)
    {
        $data = new Admin();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return back()->with('success', 'Account Create Successfully!');
    }



    //HOMEPAGE DESIGNER/*  */
    public function homepageDesign()
    {   
        $carouselImages = CarouselImage::all();
        $bannerImages = BannerImage::all();
        $productImages = ProductsWithModel::join('categories', 'products_with_models.category_id', '=', 'categories.id')
        ->select(
            'products_with_models.*',
            'categories.name as category_name'
        )
        ->get();
        return view('admin.include.homepageDesigner', ['carouselImages' => $carouselImages,'bannerImages'=>$bannerImages,'productImages'=>$productImages, 'title' => 'Homepage Design']);
    }

    //Carousel
    public function carouselUpdate(Request $request, $id)
    {

        $carousel = CarouselImage::findOrFail($id);

        $carousel->title = $request->title;
        $carousel->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $carousel->image = 'images/' . $filename;
        }
        $carousel->save();

        return back()->with('success', 'Carousel image Updated Successfully');
    }

    //Banner
    public function bannerUpdate(Request $request, $id)
    {
        $banner = BannerImage::findOrFail($id);

        $banner->title = $request->title;
        $banner->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $banner->image = 'images/' . $filename;
        }
        $banner->save();
        return back()->with('success', 'Banner image Updated Successfully');
    }

    //Category cards
    public function productWithModelsUpdate(Request $request, $id)
    {

        $product = ProductsWithModel::findOrFail($id);

        $product->title = $request->title;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $product->image = 'images/' . $filename;
        }
        $product->save();

        return back()->with('success', 'Product image Updated Successfully');
    }



    //setting
    public function setting()
    {
        return view('admin.include.setting', ['title' => 'Profile Setting']);
    }
    public function updateProfile(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user_id = auth('admin')->id();

        Admin::where('id', $user_id)->update([
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);
        return redirect('/admin')->with('success', 'Profile updated successfully! Please Log in!');
    }



    //logout
    public function logout()
    {
        Auth::forgetUser();
        Session::getHandler()->gc(0);
        return redirect('/admin');
    }


    //search
    public function searchProduct(Request $request)
    {
        $search = $request->search;
        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
                     ->where('products.name', 'LIKE', "%{$search}%")
                     ->orWhere('categories.name', 'LIKE', "%{$search}%")
                     ->select('products.*')
                     ->paginate(8);
        return view('admin.include.product', ['products' => $products, 'title' =>'Products']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Contact;
use App\Models\Appointment;
use App\Models\CarouselImage;
use App\Models\BannerImage;
use App\Models\ProductsWithModel;

class UserController extends Controller
{


    //HOME
    public function home()
    {
        $carouselImages = CarouselImage::all();
        $bannerImages = BannerImage::all();
        $productImages = ProductsWithModel::join('categories', 'products_with_models.category_id', '=', 'categories.id')
            ->select('products_with_models.*', 'categories.name as category_name')
            ->get();
    
        return view('moon.home', [
            'carouselImages' => $carouselImages,
            'bannerImages' => $bannerImages,
            'productImages' => $productImages
        ]);
    }
    




    //signUP
    public function signup()
    {
        return view('moon.signup');
    }
    public function signupPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required | email|unique:users',
            'password' => 'required|confirmed'
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        if ($user) {
            return redirect('/moon/signin')->with('success', 'Registered Successfully. Please sign in with your account');
        } else {
            return back()->withErrors(['errors' => "Register Fail.Please Try Again!"]);
        }
    }




    //signIN
    public function signin()
    {
        return view('moon.signin');
    }
    public function signinPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $users = $request->only('email', 'password');
        if (Auth::attempt($users)) {
            return redirect('/moon');
        }

        return back()->withErrors(['error' => 'Invalid email or password.']);
    }



    // logout
    public function logout()
    {
        Auth::logout();
        return redirect('/moon/signin');
    }



    //Cart
    public function AddToCart()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $user = Cart::where('user_id', $user_id)->count();
            if ($user > 0) {
                $cartItems = DB::table('carts')
                    ->join('products', 'carts.product_id', '=', 'products.id')
                    ->where('carts.user_id', $user_id)
                    ->select('products.*', 'carts.qty', 'carts.id as cart_id')
                    ->get();
                return view('moon.cart', ['cartItems' => $cartItems]);
            }
            return redirect('moon/products');

        }
        return redirect('/moon/signin')->withErrors(['You need to sign in first!']);
    }



    //wishlist
    public function AddToWishlist()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $user = Wishlist::where('user_id', $user_id)->count();
            if ($user > 0) {
                $wishlistItems = DB::table('wishlists')
                    ->join('products', 'wishlists.product_id', '=', 'products.id')
                    ->where('wishlists.user_id', $user_id)
                    ->select('products.*', 'wishlists.qty', 'wishlists.id as wishlist_id')
                    ->get();
                return view('moon.wishlist', ['wishlistItems' => $wishlistItems]);
            }
            return redirect('moon/products');
        }
        return redirect('/moon/signin')->withErrors(['You need to sign in first!']);
    }



    //About Us
    public function aboutUs()
    {
        return view('moon.aboutUs');
    }



    //Appointment
    public function book()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;
            return view('moon.bookAppoint');
        }
        return redirect('/moon/signin')->withErrors(['Please sign in to book an appointment!']);
    }

    public function appointment(Request $request)
    {
        $data = new Appointment();
        $data->user_id = Auth::user()->id;
        $data->phone = $request->phone;
        $data->appointment_date = $request->date;
        $data->appointment_time = $request->time;
        $data->appointment_message = $request->message;
        $data->save();

        return back()->with('success', 'Your appointment has been booked successfully!');
    }



    //Contact Us
    public function contactUs()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;
            return view('moon.contactUs');
        }
        return redirect('/moon/signin')->withErrors(['Please sign in to send a message!']);
    }

    public function saveMessage(Request $request)
    {
        $data = new Contact();
        $data->user_id = Auth::user()->id;
        $data->message = $request->message;
        $data->save();

        return back()->with(['success', 'Message has been sent!']);
    }


    //Location
    public function location()
    {
        return view('moon.location');
    }



    //Privacy
    public function privacy()
    {
        return view('moon.privacypolicy');
    }



    //terms of us
    public function termsOfUs()
    {
        return view('moon.termsOfUs');
    }



    //cookie
    public function cookie()
    {
        return view('moon.cookie');
    }



    //careers
    public function careers()
    {
        return view('moon.careers');
    }
}

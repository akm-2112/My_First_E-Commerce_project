<?php
      
namespace App\Http\Controllers;
       
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Stripe\Stripe;
use Stripe\Charge;

       
class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(): View
    {
        return view('moon.stripe');
    }
      
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request): RedirectResponse
{
    Stripe::setApiKey(env('STRIPE_SECRET'));
  
    Charge::create([
        "amount" => 10 * 100,
        "currency" => "usd",
        "source" => $request->stripeToken,
        "description" => "Test payment from itsolutionstuff.com."
    ]);
            
    return back()->with('success', 'Payment successful!');
}

}


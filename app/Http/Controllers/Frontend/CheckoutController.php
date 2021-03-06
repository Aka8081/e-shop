<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartitems = cart::where('user_id',Auth::id())->get();
        foreach ($old_cartitems as $item)
        {
        if(!Product::where('id', $item->prod_id)->where('qty','>=',$item->prod_qty)->exists())
            {
                $removeitem = Cart::where('user_id',Auth::id())->where('prod_id',$item->prod_id)->first();
                $removeitem->delete();
            }
        }
        $cartitems = cart::where('user_id',Auth::id())->get();

        return view('frontend.checkout',compact('cartitems'));
    }


    public function placeOrder(Request $request)
    {

        $order = new Order();
        $order->user_id = Auth::id();
        $order->name = $request->input('name');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');
        $order->total_price = $request->input('total_price');
        $order->status = '0';

        // $total_price = 0;
    
        // $cartitems_total =Cart::where ('user_id',Auth::user())->get();
        // foreach ($cartitems_total as $item) 
        // {
        //     // total += $prod->product->selling_price;
        //     $total_price += $item->products->selling_price * $item->qty;
        // }

        // $order->total_price = $total_price;
        
        $order->tracking_no = 'aka'.rand(1111,9999);
        $order->save();

        $order->id;

        $cartitems = Cart::where('user_id',Auth::id())->get();
        foreach($cartitems as $item)
        {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty'=>$item->prod_qty,
                'price' => $item->products->selling_price,
            ]);

            $prod = product::where('id',$item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            // product::where('id',$item->prod_id)->update(['$item->prod_id' => $request->qty]);
          //  dd($item->prod_qty);
            product::where('id',$item->prod_id)->decrement('qty',$item->prod_qty);
            
        }

        if(Auth::user()->address1 == NULL )
        {
            $user = User::where('id', Auth::id())->exists();
            $user->name = $request->input('name');
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->address1 = $request->input('address1');
            $user->address2 = $request->input('address2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
            $user->update();
        }

        $cartitems = Cart::where('user_id',Auth::id())->get();
        Cart::destroy($cartitems);

        return redirect('/') -> with('status','sucsess',"Order placed successfully");
    }


}

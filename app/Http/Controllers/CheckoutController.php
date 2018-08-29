<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use App\Address;
use App\OrderProduct;
use App\helpers;
use App\Product;
use App\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;
use Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use DB;


class CheckoutController extends Controller
{
    public function shipping(Request $request)
    {

      if (auth()->user() && request()->is('/guest-checkout')) {
        return redirect()->url('shipping-info');
      }
      // if ($request->isMethod('post')) {
      //   $data = $request->all();
      //   // echo "<pre>";print_r($data); die;
       
      //     $address = new Address;

      //     $address->fname = $data['fname'];
      //     $address->lname = $data['lname'];
      //     $address->place = $data['place'];
      //     $address->street = $data['street'];
      //     $address->number = $data['number'];
      //     $address->email = $data['email'];
      //     $address->save();
      //     // echo "<pre>";print_r($address);die;

      //     Auth::user()->address();

      //     return redirect()->back()->with('flash_message_success','Details Send Successfuly!');

      // }
        return view('checkout');
    }

    //create a charge but for now its cash on delivery
    public function storePayment(CheckoutRequest $request){

      $order = $this->addToOrdersTables($request, null);
      Mail::send(new OrderPlaced($order));

      return view('thankyou');
      
    }

      protected function addToOrdersTables($request, $error){
        //insert into orders table
          foreach (Cart::content() as $item) {
          $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'fname' => $request->fname,
             'lname' => $request->lname,
             'place' => $request->place,
             'street' => $request->street,
             'number' => $request->number,
             'email' => $request->email,
             'total' =>$item->total,
             'status'=>0,
             'error'=> $error,
          ]);
        }
          //insert into orderproducts table
          foreach (Cart::content() as $item) {
            OrderProduct::create([
              'order_id' => $order->id,
              'product_id' => $item->model->id,
              'quantity' => $item->qty,
            ]);
          }
            return $order;
          }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Session;
use App\Product;
use Auth;
use App\User;


class InShoppingCartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        if(!\Session::has('cart')) \Session::put('cart',array());
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product,Request $request)
    {
        $find = Product::findorFail($product->id);
        $find['cantidad'] = $request->cantidad;
        \Session::put('cart.product'.$product->id,$find);
        \Session::all();
        return redirect()->route('revision');
   }

   public function delete(Product $product){
    $cart = \Session::get('cart');
    unset($cart['product'.$product->id]);
    \Session::put('cart',$cart);
    return redirect()->route('revision');
   }

   public function payment()
   {
     $user = User::find(Auth::user()->id);
     $cart = \Session::get('cart');
    return view('pago')->with(compact('cart','user'));
   }
  
  public function finish_payment()
    {
        \Session::forget('cart');
        return redirect()->route('home')->with('success','¡Compra finalizada correctamente! Gracias por comprar en chikavi.');
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

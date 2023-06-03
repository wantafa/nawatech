<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {
        $product = Product::all();
        $cart = Cart::where('user_id', Auth::user()->id)->count();

        return view('order.product', compact('product', 'cart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function to_cart(Request $request)
    {
        $product_id = $request->input('product_id');
        $qty = $request->input('qty');
        
        
        $cart = Cart::where('product_id', $product_id)->first();
        
        if ($cart) {
            $cart->user_id = Auth::user()->id;
    
            $cart->qty += $qty;

        if ($request->input('cart')) {
            $cart->qty = $qty;
            $cart->save();
        }
            $cart->save();
    
        } else {
            $cart = new Cart();
            $cart->product_id = $product_id;
            $cart->user_id = Auth::user()->id;
            $cart->qty = $qty;
            $cart->save();
        }
        
        return response()->json(['success' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $cart = Cart::join('product', 'cart.product_id', 'product.id')->select('cart.*', 'product.jenis', 'product.merek', 'product.harga', 'product.foto')->where('user_id', Auth::user()->id)->get();

        return view('order.cart', compact('cart'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function proses_checkout(Request $request)
    {
        $req = $request->all();

        $req['no_trx'] = rand(100, 1000);
        $req['user_id'] = Auth::user()->id;

        $order = Order::create($req)->id;

        for ($i = 0; $i < count($req['product_id']); $i++) {

            OrderProduct::create([
                'order_id' => $order,
                'product_id' => $req['product_id'][$i],
                'user_id' => Auth::user()->id,
                'qty' => $req['qty'][$i],
            ]);

            $product = Product::find($req['product_id'][$i]);

            $req['stok'] = $product->stok - $req['qty'][$i];

            $product->update($req);

            $cart = Cart::find($req['id'][$i]);
            $cart->delete();
            
        }
        
        
        return redirect('order/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

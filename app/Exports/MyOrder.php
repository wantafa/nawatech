<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class MyOrder implements FromView
{
    public function view(): View
    {
        $order = Order::join('order_product', 'order.id', 'order_product.order_id')
        ->join('product', 'order_product.product_id', 'product.id')
        ->where('order.user_id', Auth::user()->id)
        ->select('product.jenis', 'product.merek', 'product.foto', 'order.id as id', 'order.total', 'order.no_trx', 'order_product.qty')
        ->orderByDesc('order.id')->get();
        $no = 1;
        
        return view('my_order.export', compact('order', 'no'));
    }
}
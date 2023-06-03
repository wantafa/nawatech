<?php

namespace App\Http\Controllers;

use Excel;
use App\Models\Order;
use App\Exports\MyOrder;
use App\Models\Cart;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
{
    public function dataJson()
    {
        return DataTables::of(Order::join('order_product', 'order.id', 'order_product.order_id')
        ->join('product', 'order_product.product_id', 'product.id')
        ->where('order.user_id', Auth::user()->id)
        ->select('product.jenis', 'product.merek', 'product.foto', 'order.id as id', 'order.total', 'order.no_trx', 'order_product.qty')
        ->orderByDesc('order.id')->get())

        ->addColumn('action', function ($row) {
            $action = '<a href="javascript:void(0);" data-id="' . $row->id . '" class="btn btn-md btn-delete"><i class="bx bxs-trash"></i></a>';
            return $action;
        })
        ->addIndexColumn()
        ->make(true);
    }

    public function index()
    {
        return view('my_order.index');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return back();
    }
    
    public function destroy_cart($id)
    {
        $order = Cart::find($id);
        $order->delete();

        return back();
    }

    public function export()
    {
        $order = 'My Order '.date('d F H').'.xlsx';
        return Excel::download(new MyOrder, $order);
    }
}

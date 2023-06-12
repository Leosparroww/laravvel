<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_list;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList()
    {
        $order = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'desc')
            ->paginate('5');

        return view('admin.order.list', compact('order'));
    }
    //ajax status
    public function changeStatus(Request $request)
    {
        // $request->status = $request->status == null ? "" : $request->status;
        $order = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'desc');
        if ($request->orderStatus == null) {
            $order = $order->paginate('5');
        } else {
            $order = $order->where('status', $request->orderStatus);
            $order = $order->paginate('5');

        }
        $order->appends(request()->all());

        return view('admin.order.list', compact('order'));

    }

    // ajax change status

    public function ajaxChangeStatus(Request $request)
    {
        logger($request->all());
        Order::where('id', $request->order_id)->update([
            'status' => $request->status,
        ]);
    }
    //order list info

    public function orderListInfo($orderCode)
    {

        $orderPrice = Order::select('total_price')->where('order_code', $orderCode)->first();

        $orderInfo = Order_list::select('order_lists.*', 'users.name as user_name', 'products.name as product_name', 'products.image as product_image')
            ->where('order_code', $orderCode)
            ->leftJoin('users', 'users.id', 'order_lists.user_id')
            ->leftJoin('products', 'products.id', 'order_lists.product_id')

            ->get();
        //dd($orderInfo->toArray());
        return view('admin.order.listInfo', compact('orderInfo', 'orderPrice'));

    }
}

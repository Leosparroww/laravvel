<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //sorting pizza
    public function pizzaList(Request $request)
    {
        logger($request->all());
        if ($request->status == 'desc') {
            $data = Product::OrderBy('created_at', 'desc');
            if ($request->id != 0) {
                $data = $data->where('category_id', $request->id)->get();
            } else {
                $data = $data->get();
            }
        } else {
            $data = Product::OrderBy('created_at', 'asc');
            if ($request->id != 0) {
                $data = $data->where('category_id', $request->id)->get();
            } else {
                $data = $data->get();
            }

        }

        return $data;

    }
    // add to cart
    public function addToCart(Request $request)
    {
        $data = $this->getOrderData($request);

        Cart::create($data);
        $response = [
            'message' => 'added to Cart',
            'status' => 'success',
        ];
        return response()->json($response, 200);

    }
    public function order(Request $request)
    {
        $totalPrice = 0;
        foreach ($request->all() as $item) {
            $data = OrderList::create(
                [
                    'user_id' => $item['user_id'],
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'total' => $item['total'],
                    'order_code' => $item['order_code'],
                ]
            );
            $totalPrice += $data->total;
        }

        Cart::where('user_id', Auth::user()->id)->delete();
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data['order_code'],
            'total_price' => $totalPrice + 3000,
            'status' => 0,
        ]);
        return response()->json([
            'status' => 'true',
            'message' => 'order completed',
        ], 200);
    }
    //clear cart

    public function clearCart()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
    }

    //clear current product from cart
    public function clearCurrentProduct(Request $request)
    {
        logger($request->all());
        Cart::where('user_id', Auth::user()->id)
            ->where('id', $request->cartId)->delete()
        ;
    }
    // view count
    public function viewcount(Request $request)
    {
        $product = Product::where('id', $request->productId)->first();
        $viewCount = [
            'view_count' => $product->view_count + 1,
        ];
        Product::where('id', $request->productId)->update($viewCount);

    }
    //order data
    private function getOrderData($request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
        ];
    }
}
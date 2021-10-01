<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required'
        ]);

        if(!$request->filled('coupons')) {
            $coupon = 'No Coupon Code';
        }elseif (!$request->coupons == "GO2018") {
            $coupon = 'Invalid Coupon Code';
        }
        else {
            $coupon = (double) 0.10;
        }

        date_default_timezone_set('Asia/Manila');

        foreach($request->carts as $cart) {
            foreach($cart as $value) {
                $order = new Order([
                    'name' => $request->name,
                    'coupons' => $request->coupons ?? null,
                    'menu_id' => $value,
                    'date_order' => date('m-d-Y')
                ]);

                $order->save();
            }
        }

        return $coupon;

    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Order;
use EasyWeChat\Foundation\Application;


class WxpayController extends Controller
{

    public function notify(Request $request) {/*{{{*/
        $options = config('wechat');
        $app = new Application($options);

        $response = $app->payment->handleNotify(function($notify, $successful) {
            $order_no = $notify->out_trade_no;
            $order = Order::where('order_no', $order_no)->first();
            if (!$order) {
                return 'Order not exist';
            }

            if ($order->status == ORDER_STATUS_SUCCESS) {
                return true;
            }

            if ($successful) {
                $order->status = ORDER_STATUS_SUCCESS;
                // do something you should do after paid successfully
            } else {
                $order->status = ORDER_STATUS_PAYERROR;
            }
            $order->save();

            return true;
        });

        return $response;
    }/*}}}*/

}

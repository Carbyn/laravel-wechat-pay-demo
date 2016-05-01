<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;

class BuyController extends Controller
{

    const NOTIFY_URL = 'http://your-website/pay/weixin/notify';

    public function index(Request $request) {/*{{{*/
        $result = $this->prepay();
        if ($result) {
            return view('buy')
                ->with('jsApiParams', $result['jsApiParams']);
        }

        abort(404);
    }/*}}}*/

    protected function prepay() {/*{{{*/
        $options = config('wechat');
        $app = new Application($options);

        $payment = $app->payment;

        $user = session('wechat.oauth_user');
        $openid = $user->getId();

        $order_no = $this->genOrder($openid);
        if (!$order_no) {
            return false;
        }

        $attributes = [
            'body' => 'laravel-wechat-pay-demo',
            'detail' => 'laravel-wechat-pay-demo',
            'total_fee' => 1,
            'out_trade_no' => $order_no,
            'fee_type' => 'CNY',
            'time_start' => date('YmdHis'),
            'time_expire' => date('YmdHis', time() + 600),
            'notify_url' => self::NOTIFY_URL,
            'trade_type' => 'JSAPI',
            'openid' => $openid,
        ];
        $order = new Order($attributes);

        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            $jsApiParams = $payment->configForPayment($result->prepay_id);
            return compact('jsApiParams');
        }

        return false;
    }/*}}}*/

    protected function genOrder($openid) {/*{{{*/
        $order_no = date('YmdHis').substr(microtime(), 2, 5).mt_rand(1000, 9999);

        $order = new \App\Order();
        $order->order_no = $order_no;
        $order->openid = $openid;
        $order->status = ORDER_STATUS_USERPAYING;
        if ($order->save()) {
            return $order_no;
        }

        return false;
    }/*}}}*/

}

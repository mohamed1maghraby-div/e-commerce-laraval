<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\OmnipayService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class PaymentCobntroller extends Controller
{
    public function checkout_now(Request $request)
    {
        $order = (new OrderService)->createOrder($request->except(['_token', 'submit']));
        $omniPay = new OmnipayService('PayPal_Express');
        $response = $omniPay->purchase([
            'amount' => $order->total,
            'transactionId' => $order->id,
            'currency' => 'USD',
            'cancelUrl' => $omniPay->getCancelUrl($order->id),
            'returnUrl' => $omniPay->getReturnUrl($order->id)
        ]);

        if($response->isRedirect()){
            $response->redirect();
        }
        toast($response->getMessage(), 'error');
        return redirect()->route('frontend.index');
    }

    public function cancelled($order_id)
    {

    }

    public function completed($order_id)
    {

    }

    public function webhook($order, $env)
    {

    }


}

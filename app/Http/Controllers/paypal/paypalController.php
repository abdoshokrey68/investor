<?php

namespace App\Http\Controllers\paypal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Srmklive\PayPal\Services\ExpressCheckout;
// use Srmklive\PayPal\Services\AdaptivePayments;

class paypalController extends Controller
{
    public function index()
    {
        return view('paypal');
    }

    public function handlePayment()
    {
        $product = [];
        $product['items'] = [
            [
                'name' => 'Subscripe Success',
                'price' => 200,
                'desc'  => 'We are pleased to be honored to partner with us on the site and work with us',
                'qty' => 2
            ]
        ];

        $product['invoice_id'] = 1;
        $product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
        $product['return_url'] = route('success.payment');
        $product['cancel_url'] = route('cancel.payment');
        $product['total'] = 224;

        $paypalModule = new ExpressCheckout;
        // $provider = new AdaptivePayments;     // To use adaptive payments.

        $res = $paypalModule->setExpressCheckout($product);
        $res = $paypalModule->setExpressCheckout($product, true);

        return redirect($res['paypal_link']);
    }

    public function paymentCancel()
    {
        dd('Your payment has been declend. The payment cancelation page goes here!');
    }

    public function paymentSuccess(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Payment was successfull. The payment success page goes here!');
        }

        dd('Error occured!');
    }
}

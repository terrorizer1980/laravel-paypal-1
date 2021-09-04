<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\Paypal\Services\ExpressCheckout;

class PaypalPaymentController extends Controller
{
    //
    public function handlePayment()
    {
        $product = [];
        $product['items'] = [
            [
                'name' => 'Nike Joyride 2',
                'price' => 112,
                'desc' => 'Running shoes fvor men',
                'qty' => 2
            ]
        ];
        $product['invoice_id'] = 1;
        $product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
        $product['return_url'] = route('success.payment');
        $product['cancel_url'] = route('cancel.payment');
        $product['total'] = 3000;

        $paypalModule = new ExpressCheckout;

        $res = $paypalModule->setExpressCheckout($product);
        $res = $paypalModule->setExpressCheckout($product, true);

        return redirect($res['paypal_link']);
    }

    public function paymentCancel()
    {
        dd('Your payment has been declined. Blah blah blah');
    }

    public function paymentSuccess(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);

        if(in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('The payment was successful. Blah blah blah!');
        }

        dd('An Error occured!');
    }
}

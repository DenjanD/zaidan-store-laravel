<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function process(Request $request) {
        // Save user's data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // Checkout
        $code = "STORE-" . mt_rand(00000,99999);
        $carts = Cart::with(['product','user'])
                        ->where('user_id',Auth::user()->user_id)
                        ->get();

        // Create transaction
        $transaction = Transaction::create([
            'user_id' => Auth::user()->user_id,
            'insurance' => 0,
            'shipping' => 0,
            'total' => $request->total_price,
            'status' => 'PENDING',
            'code' => $code
        ]);

        // Create transaction detail
        foreach ($carts as $cartItem) {
            $trx = 'TRX-' . mt_rand();

            $transactionDetail = TransactionDetail::create([
                'transaction_id' => $transaction->transaction_id,
                'product_id' => $cartItem->product->product_id,
                'product_price' => $cartItem->product->price,
                'shipping_status' => 'PENDING',
                'receipt' => '',
                'code' => $trx
            ]);
        }

        Cart::where('user_id', Auth::user()->user_id)->delete();
        
        // Midtrans Config
        Config::$serverKey = config('services.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.isProduction');;
        // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.isSanitized');;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('services.midtrans.is3ds');;

        // array to midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payment' => [
                'gopay', 'permata_va' ,'bank_transfer'
            ],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            
            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        }catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(Request $request) {
        
    }
}

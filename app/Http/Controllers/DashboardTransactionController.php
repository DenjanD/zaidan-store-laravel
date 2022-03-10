<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    public function index() {
        $sellTransactions = TransactionDetail::with(['transaction.user','product.photos'])
                                        ->whereHas('product', function($product) {
                                            $product->where('user_id', Auth::user()->user_id);
                                        })->get();

        $buyTransactions = TransactionDetail::with(['transaction.user','product.photos'])
                                        ->whereHas('transaction', function($transaction) {
                                            $transaction->where('user_id', Auth::user()->user_id);
                                        })->get();

        return view('pages.dashboard-transactions', [
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions
        ]);
    }

    public function details(Request $request, $id) {
        $transaction = TransactionDetail::with(['transaction.user','product.photos'])
                                        ->findOrFail($id);

        return view('pages.dashboard-transactions-details', [
            'transaction' => $transaction
        ]);
    }

    public function update(Request $request, $id) {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transactions-details', $item->detail_id);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Insufficient stock.');
        }

        DB::transaction(function () use ($request, $product) {
            $totalAmount = $product->price * $request->quantity;

            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);

            $product->decrement('stock', $request->quantity);

            // Send Email
            try {
                \Illuminate\Support\Facades\Mail::to(Auth::user()->email)->send(new \App\Mail\NewOrderMail($transaction));
            } catch (\Exception $e) {
                // Log error or ignore if mail fails
            }
        });

        return redirect()->route('marketplace.index')->with('success', 'Transaction created successfully.');
    }
}

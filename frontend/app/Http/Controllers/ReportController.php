<?php

namespace App\Http\Controllers;

use App\Support\DummyTransactions;

class ReportController extends Controller
{

    public function index()
    {
        $transactions = collect(
            session(
                'report_transactions',
                \App\Support\DummyTransactions::all()
            )
        );

        $transactions = $transactions->when(
            request('type'),
            fn($items, $type) => $items->where('type', $type)
        );

        $transactions = $transactions->when(
            request('start_date'),
            fn($items, $date) => $items->where('date', '>=', $date)
        );

        $transactions = $transactions->when(
            request('end_date'),
            fn($items, $date) => $items->where('date', '<=', $date)
        );

        $transactions = $transactions->when(
            request('min_amount') !== null
                && request('min_amount') !== '',
            fn($items) => $items->where(
                'amount',
                '>=',
                (float) request('min_amount')
            )
        );

        $transactions = $transactions->when(
            request('max_amount') !== null
                && request('max_amount') !== '',
            fn($items) => $items->where(
                'amount',
                '<=',
                (float) request('max_amount')
            )
        );

        return view('report', [
            'transactions' => $transactions->values()->all(),
        ]);
    }


    public function update(\Illuminate\Http\Request $request, $id)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'description' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'type' => 'required|in:income,outcome',
            'amount' => 'required|numeric|min:0',
        ]);

        $transactions = session(
            'report_transactions',
            \App\Support\DummyTransactions::all()
        );

        $found = false;

        foreach ($transactions as &$transaction) {
            if ((string) $transaction['id'] === (string) $id) {
                $transaction['date'] = $validated['date'];
                $transaction['description'] = $validated['description'];
                $transaction['category'] = $validated['category'];
                $transaction['type'] = $validated['type'];
                $transaction['amount'] = $validated['amount'];

                $found = true;
                break;
            }
        }

        unset($transaction);

        if (!$found) {
            return redirect('/report')
                ->with('error', 'Transaksi tidak ditemukan.');
        }

        session(['report_transactions' => $transactions]);

        return redirect('/report')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }
}

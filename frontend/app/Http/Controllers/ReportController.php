<?php

namespace App\Http\Controllers;

use App\Support\DummyTransactions;

class ReportController extends Controller
{

    public function index()
    {
        $transactions = collect(
            \App\Support\DummyTransactions::all()
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
}

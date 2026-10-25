<?php

namespace App\Http\Controllers;

use App\Support\DummyTransactions;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = \App\Support\DummyTransactions::all();

        $activities = collect($transactions)
            ->sortByDesc('date')
            ->sortByDesc('id')
            ->take(5);

        return view('dashboard', compact('activities', 'transactions'));
    }

    public function analytics()
    {
        $transactions = \App\Support\DummyTransactions::all();

        return view('analytics', compact('transactions'));
    }
}

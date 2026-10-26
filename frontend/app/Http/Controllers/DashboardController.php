<?php

namespace App\Http\Controllers;

use App\Support\DummyTransactions;

class DashboardController extends Controller
{

    public function index()
    {
        $transactions = \App\Support\DummyTransactions::all();

        $activities = collect($transactions)
            ->sortByDesc('id')
            ->take(5);

        $savingGoals = \App\Models\SavingGoal::latest()->get();

        return view('dashboard', compact(
            'activities',
            'transactions',
            'savingGoals'
        ));
    }


    public function analytics()
    {
        $transactions = \App\Support\DummyTransactions::all();

        return view('analytics', compact('transactions'));
    }
}

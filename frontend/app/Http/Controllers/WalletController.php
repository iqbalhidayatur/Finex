<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index(Request $request)
    {
        $query = Wallet::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        $wallets = $query->latest()->get();

        $categories = Wallet::query()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('management', compact('wallets', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'budget' => ['required', 'numeric', 'min:0', 'max:9999999999999.99'],
            'category' => ['required', 'string', 'max:100'],
        ]);

        Wallet::create($validated);

        return redirect()
            ->route('wallets.index')
            ->with('success', 'Wallet berhasil ditambahkan.');
    }

    public function edit(Wallet $wallet)
    {
        return response()->json($wallet);
    }

    public function update(Request $request, Wallet $wallet)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'budget' => ['required', 'numeric', 'min:0', 'max:9999999999999.99'],
            'category' => ['required', 'string', 'max:100'],
        ]);

        $wallet->update($validated);

        return redirect()
            ->route('wallets.index')
            ->with('success', 'Wallet berhasil diperbarui.');
    }

    public function destroy(Wallet $wallet)
    {
        $wallet->delete();

        return redirect()
            ->route('wallets.index')
            ->with('success', 'Wallet berhasil dihapus.');
    }
}

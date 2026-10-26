<?php

namespace App\Http\Controllers;

use App\Models\SavingGoal;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SavingGoalController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'target_amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999.99'],
            'saved_amount' => ['required', 'numeric', 'min:0', 'lte:target_amount'],
            'target_date' => ['nullable', 'date', 'after_or_equal:today'],
        ]);

        SavingGoal::create($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Saving goal berhasil dibuat.');
    }

    public function update(Request $request, SavingGoal $savingGoal)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'target_amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999.99'],
            'saved_amount' => ['required', 'numeric', 'min:0', 'lte:target_amount'],
            'target_date' => ['nullable', 'date'],
        ]);

        $savingGoal->update($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Saving goal berhasil diperbarui.');
    }

    public function destroy(SavingGoal $savingGoal)
    {
        $savingGoal->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Saving goal berhasil dihapus.');
    }

    public function addSavings(Request $request, SavingGoal $savingGoal)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999.99'],
        ]);

        $amount = (float) $validated['amount'];

        $savingGoal->refresh();

        if ($amount > (float) $savingGoal->target_amount - (float) $savingGoal->saved_amount) {
            throw ValidationException::withMessages([
                'amount' => 'Nominal tabungan melebihi sisa target.',
            ]);
        }

        $savingGoal->increment('saved_amount', $amount);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Tabungan berhasil ditambahkan.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BonusPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BonusPaymentController extends Controller
{
    public function index(Request $request)
    {
        $bonusPayments = BonusPayment::query()
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(5);

        return Inertia::render('Bonus/Index', [
            'bonusPayments' => $bonusPayments
        ]);
    }

    public function create()
    {
        return Inertia::render('Bonus/Create');
    }

    public function store(Request $request)
    {
        $bonusRequest = $request->all();

        foreach ($bonusRequest['employees'] as $bonus) {
            BonusPayment::create([
                'name' => $bonus['name'],
                'percentage' => $bonus['percent'],
                'total' => $bonus['total'],
                'payments' => $bonusRequest['bonus']
            ]);
        }

        return Inertia::render('Bonus/Index');
    }

    public function edit(Request $request, $id)
    {
        $bonus = BonusPayment::query()->find($id);

        return Inertia::render('Bonus/Edit', [
            'bonusPayment' => $bonus
        ]);
    }

    public function update(Request $request, $id)
    {
        $bonusRequest = $request->all();
        $bonus = BonusPayment::query()->find($id);
        $bonus->update($bonusRequest);

        return Redirect::route('bonus-payments.edit', $id);
    }

    public function destroy(Request $request, $id)
    {
        $bonus = BonusPayment::query()->find($id);
        $bonus->delete();
        return Redirect::route('bonus-payments');
    }
}

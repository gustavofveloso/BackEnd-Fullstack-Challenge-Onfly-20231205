<?php

namespace App\Http\Controllers\Api\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Requests\ExpenseRequest;

class ExpenseController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Expense::class);
        $expenses = Expense::where('user_id', auth()->id())->get();
        return response()->json(['expenses' => $expenses], 200);
    }

    public function store(ExpenseRequest $request)
    {
        $this->authorize('create', Expense::class);
        
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $expense = Expense::create($data);

        return response()->json(['expense' => $expense], 201);
    }

    public function show(Expense $expense)
    {
        $this->authorize('view', $expense);
        return response()->json(['expense' => $expense], 200);
    }

    public function update(ExpenseRequest $request, Expense $expense)
    {
        $this->authorize('update', $expense);
        $expense->update($request->validated());
        return response()->json(['expense' => $expense], 200);
    }

    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);
        $expense->delete();
        return response()->json(['message' => 'Expense deleted successfully'], 200);
    }
}

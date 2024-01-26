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
        $perPage = request()->input('per_page', 10);
        $expenses = Expense::where('user_id', auth()->id())->paginate($perPage);
    
        $response = [
            'data' => $expenses->items(),
            'meta' => [
                'current_page' => $expenses->currentPage(),
                'from' => $expenses->firstItem(),
                'last_page' => $expenses->lastPage(),
                'per_page' => $expenses->perPage(),
                'to' => $expenses->lastItem(),
                'total' => $expenses->total(),
            ]
        ];
    
        return response()->json($response, 200);
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

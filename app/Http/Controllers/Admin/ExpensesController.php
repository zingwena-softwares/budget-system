<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Department;
use App\Expense;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExpenseRequest;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Programm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpensesController extends Controller
{
    public function index()
    {

        $expenses = Expense::all();

        return view('admin.expenses.index', compact('expenses'));
    }

    public function create()
    {
        $programmes = Programm::all()->pluck('programe', 'id')->prepend(trans('global.pleaseSelect'), '');


        $categories  = Category::all()->pluck('name', 'id')->prepend(trans('Please select'), '');


        return view('admin.expenses.create', compact('programmes', 'categories'));
    }

    public function store(Request $request)
    {

        $attrs = $request->validate([
            'description' => 'required|string',
            'category_id' => 'required|string',
            'program_id' => 'required|string',
            'quantity' => 'required|numeric',
            'amount' => 'required|numeric',
            'vat' => 'required|numeric',
        ]);

        Expense::create([
            'description' => $attrs['description'],
            'category_id' => $attrs['category_id'],
            'program_id' => $attrs['program_id'],
            'unit_measure' => 'each',
            'period' => 'per annum',
            'quantity' => $attrs['quantity'],
            'amount' => $attrs['amount'],
            'vat' => $attrs['vat'],
            'total_exclusive' => (int)$attrs['amount']*(int)$attrs['quantity'],
            'total_inclusive' => (int)$attrs['amount']*(int)$attrs['quantity']+(int)$attrs['vat'],

        ]);

        return redirect()->route('admin.expenses.index');
    }

    public function edit(Expense $expense)
    {

        $categories  = Category::all()->pluck('name', 'id')->prepend(trans('Please select'), '');

        $programmes = Programm::all()->pluck('programe', 'id')->prepend(trans('global.pleaseSelect'), '');

        $expense->load('category');

        return view('admin.expenses.edit', compact('categories', 'programmes', 'expense'));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->all());

        return redirect()->route('admin.expenses.index');
    }

    public function show(Expense $expense)
    {

        $expense->load('category');

        return view('admin.expenses.show', compact('expense'));
    }

    public function destroy(Expense $expense)
    {

        $expense->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpenseRequest $request)
    {
        Expense::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

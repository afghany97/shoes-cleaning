<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Http\Requests\CreateExpenseFormRequest;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::latest()->paginate(10);

        return view('expenses.index',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateExpenseFormRequest $formRequest
     * @return void
     */
    public function store(CreateExpenseFormRequest $formRequest)
    {
        $expense = Expense::create([
            'quantity' => request('quantity'),
            'description'  => request('description')
        ]);

        return $expense ?

            redirect()->route('expenses.index')->withSuccess('Expense created successfully') :

            back()->withErrors("Failed create Expense");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\expense $expense
     * @return void
     */
    public function show(expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\expense $expense
     * @return void
     */
    public function edit(expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\expense $expense
     * @return void
     */
    public function update(expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\expense $expense
     * @return void
     * @throws \Exception
     */
    public function destroy(expense $expense)
    {
        $deleted = $expense->delete();

        return $deleted ?

            redirect()->route('expenses.index')->withSuccess('Expense deleted successfully') :

            back()->withErrors("Failed to delete Expense");
    }
}

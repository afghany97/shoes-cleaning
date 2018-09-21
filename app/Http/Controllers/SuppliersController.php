<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierCreateFormRequest;
use App\Supplier;

class SuppliersController extends Controller
{
    /**
     * SuppliersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::latest()->undeleted()->get();

        return view('suppliers.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SupplierCreateFormRequest $formRequest
     * @return void
     */
    public function store(SupplierCreateFormRequest $formRequest)
    {
        $supplier = Supplier::create(request()->only('name','address','code','contact_person','contact_information'));

        return $supplier ?

            redirect(route('suppliers'))->withSuccess('Supplier created successfully') :

            back()->withErrors('Supplier creating fails');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Supplier $supplier
     * @param SupplierCreateFormRequest $formRequest
     * @return void
     */
    public function update(Supplier $supplier , SupplierCreateFormRequest $formRequest)
    {
        $supplier = $supplier->update(request()->only('name','address','code','contact_person','contact_information'));

        return $supplier ?

            redirect(route('suppliers'))->withSuccess('Supplier updated successfully') :

            back()->withErrors('Supplier updating fails');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        return $supplier->softDelete() ?

            redirect(route('suppliers'))->withSuccess('Supplier deleted successfully') :

            back()->withErrors('Supplier deleting fails');
    }
}

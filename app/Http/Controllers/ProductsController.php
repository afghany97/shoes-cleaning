<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateFormRequest;
use App\Product;
use App\Supplier;

class ProductsController extends Controller
{
    /**
     * ProductsController constructor.
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
        $products = Product::latest()->undeleted()->get();

        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::pluck('name', 'id');

        return view('products.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductCreateFormRequest $formRequest
     * @return void
     */
    public function store(ProductCreateFormRequest $formRequest)
    {
        request('image_path') ?

            $imageData = ['image_path' => request()->file('image_path')->store('products_images','public')] :

            $imageData = [];

        $product = Product::create(array_merge(request()->only(['supplier_id','description','price','quantity']),$imageData));

        return $product ?

            redirect(route('products'))->withSuccess('Product created successfully') :

            back()->withErrors('Product creating fails');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $suppliers = Supplier::pluck('name', 'id');

        return view('products.edit',compact('product','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Product $product
     * @param ProductCreateFormRequest $formRequest
     * @return void
     */
    public function update(Product $product,ProductCreateFormRequest $formRequest)
    {
        request('image_path') ?

            $imageData = ['image_path' => request()->file('image_path')->store('products_images','public')] :

            $imageData = [];

        $updated = $product->update(array_merge(request()->only(['supplier_id','description','price','quantity']),$imageData));

        return $updated ?

            redirect(route('products'))->withSuccess('Product updated successfully') :

            back()->withErrors('Product updating fails');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $deleted = $product->softDelete();

        return $deleted ?

            redirect(route('products'))->withSuccess('Product deleted successfully') :

            back()->withErrors('Product deleting fails');

    }
}

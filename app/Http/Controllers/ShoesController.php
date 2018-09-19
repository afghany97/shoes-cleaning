<?php

namespace App\Http\Controllers;

use App\Http\Requests\shoesFormRequest;
use App\Shoe;
use Illuminate\Http\Request;

class ShoesController extends Controller
{
    /**
     * ShoesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shoes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param shoesFormRequest $formRequest
     * @return \Illuminate\Http\Response
     */
    public function store(shoesFormRequest $formRequest)
    {
        Shoe::addShoes();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shoe  $shoes
     * @return \Illuminate\Http\Response
     */
    public function show(Shoe $shoes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shoe  $shoes
     * @return \Illuminate\Http\Response
     */
    public function edit(Shoe $shoes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shoe  $shoes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shoe $shoes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shoe  $shoes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shoe $shoes)
    {
        //
    }
}

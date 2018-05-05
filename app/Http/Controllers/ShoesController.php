<?php

namespace App\Http\Controllers;

use App\shoes;
use Illuminate\Http\Request;

class ShoesController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\shoes  $shoes
     * @return \Illuminate\Http\Response
     */
    public function show(shoes $shoes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\shoes  $shoes
     * @return \Illuminate\Http\Response
     */
    public function edit(shoes $shoes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\shoes  $shoes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, shoes $shoes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\shoes  $shoes
     * @return \Illuminate\Http\Response
     */
    public function destroy(shoes $shoes)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLockersFormRequest;
use App\Locker;
use Illuminate\Http\Request;

class LockersController extends Controller
{
    /**
     * LockersController constructor.
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
        $lockers = Locker::undeleted()->get();

        return view('lockers.index',compact('lockers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lockers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateLockersFormRequest $formRequest
     * @return void
     */
    public function store(CreateLockersFormRequest $formRequest)
    {
        $range = range(request('start'),request('end'));

        foreach ($range as $number){

            Locker::create([

               'number' => $number,
                'type' => request('type')
            ]);
        }

        return redirect(route('lockers'))->withSuccess('Lockers Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Locker  $locker
     * @return \Illuminate\Http\Response
     */
    public function show(Locker $locker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Locker  $locker
     * @return \Illuminate\Http\Response
     */
    public function edit(Locker $locker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Locker  $locker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Locker $locker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Locker $locker
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Locker $locker)
    {
        $deleted = $locker->softDelete();

        return $deleted ?

            redirect(route('lockers'))->withSuccess('Locker deleted successfully') :

            redirect(route('lockers'))->withErrors('Failed delete locker');

    }
}

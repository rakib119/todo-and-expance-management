<?php

namespace App\Http\Controllers;

use App\Models\Expance;
use Illuminate\Foundation\Auth;
use Illuminate\Http\Request;

class ExpanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        return view('Expance.index', [
            "noOfExpance" => Expance::count(),
            'Expances' => Expance::all()->where('added_by', auth()->id())

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Expance.create');
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
     * @param  \App\Models\Expance  $expance
     * @return \Illuminate\Http\Response
     */
    public function show(Expance $expance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expance  $expance
     * @return \Illuminate\Http\Response
     */
    public function edit(Expance $expance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expance  $expance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expance $expance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expance  $expance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expance $expance)
    {
        //
    }
}

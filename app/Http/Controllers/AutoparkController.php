<?php

namespace App\Http\Controllers;

use App\Autopark;
use Illuminate\Http\Request;

class AutoparkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('autopark.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Autopark  $autopark
     * @return \Illuminate\Http\Response
     */
    public function show(Autopark $autopark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Autopark  $autopark
     * @return \Illuminate\Http\Response
     */
    public function edit(Autopark $autopark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Autopark  $autopark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autopark $autopark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Autopark  $autopark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autopark $autopark)
    {
        //
    }
}

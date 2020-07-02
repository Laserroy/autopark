<?php

namespace App\Http\Controllers;

use App\Autopark;
use App\Car;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCar;
use App\Http\Requests\UpdateCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Auth::user()->createdCars;
        return view('car.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCar $request)
    {
        $number = $request->input('number');
        $driver = $request->input('driver');
        $user = Auth::user();
        Car::create([
            'number' => $number,
            'driver' => $driver,
            'created_by' => $user->id
        ]);

        return redirect(route('cars.index'))->with('status', 'Car was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        return view('car.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCar $request, Car $car)
    {
        $number = $request->input('number');
        $driver = $request->input('driver');
        $car->update(['number' => $number, 'driver' => $driver]);

        return redirect(route('cars.index'))->with('status', 'Car was updated');
    }
}

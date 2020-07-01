<?php

namespace App\Http\Controllers;

use App\Autopark;
use App\Car;
use App\Http\Requests\StoreCar;
use App\Http\Requests\UpdateCar;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
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

        $newCar = Car::create(['number' => $number, 'driver' => $driver]);

        $autoparksIDs = $request->input('autoparks');
        $newCar->autoparks()->sync($autoparksIDs);

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
        $allAutoparks = Autopark::all();
        $collection = $allAutoparks->diff($car->autoparks);
        $autoparksToAttach = $collection->all();
        return view('car.edit', compact('car', 'autoparksToAttach'));
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
        $autoparksAdd = $request->input('autoparksToAdd') ?? [];
        $autoparksRemove = $request->input('autoparksToRemove') ?? [];
        $autoparksForSync = array_merge($autoparksAdd, $autoparksRemove);
        $car->update(['number' => $number, 'driver' => $driver]);
        $car->autoparks()->toggle($autoparksForSync);

        return redirect(route('cars.index'))->with('status', 'Car was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->autoparks()->detach();
        $car->delete();

        return redirect(route('cars.index'))->with('status', 'Car was deleted');
    }
}

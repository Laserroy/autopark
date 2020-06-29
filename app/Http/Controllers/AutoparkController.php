<?php

namespace App\Http\Controllers;

use App\Autopark;
use App\Car;
use App\Http\Requests\StoreAutopark;
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
        $autoparks = Autopark::all();
        return view('autopark.index', compact('autoparks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('autopark.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAutopark $request)
    {
        $autopark = Autopark::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'work_hours' => $request->input('hours')
        ]);
        foreach ($request->input('cars') as $car) {
            $newCar = Car::firstOrCreate(
                ['number' => $car['number']],
                ['number' => $car['number'], 'driver' => $car['driver']]
            );
            $autopark->cars()->attach($newCar->id);
        }

        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Autopark  $autopark
     * @return \Illuminate\Http\Response
     */
    public function show(Autopark $autopark)
    {
        return view('autopark.show', compact('autopark'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Autopark  $autopark
     * @return \Illuminate\Http\Response
     */
    public function edit(Autopark $autopark)
    {
        return view('autopark.edit', compact('autopark'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Autopark  $autopark
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAutopark $request, Autopark $autopark)
    {
        foreach ($request->input('newCars') as $car) {
            $newCar = Car::firstOrCreate(
                ['number' => $car['number']],
                ['number' => $car['number'], 'driver' => $car['driver']]
            );
            if (!$newCar->belongsTo($autopark)) {
                $autopark->cars()->attach($newCar->id);
            }
        }
        $autopark->save();

        foreach ($request->input('updatedCars') as $car) {
            Car::whereId($car['id'])->update(['number' => $car['number'], 'driver' => $car['driver']]);
        }
        return view('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Autopark  $autopark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autopark $autopark)
    {
        $autopark->cars()->detach();
        $autopark->delete();
        return redirect(route('autoparks.index'));
    }
}

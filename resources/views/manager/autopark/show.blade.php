@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1>{{ $autopark->name }}</h1>
    <p>{{ $autopark->address }}</p>
    <p>{{ $autopark->work_hours }}</p>
    <table class="table w-50 mx-auto">
        <thead class="thead-light">
          <tr>
            <th scope="col">{{ __('car.number') }}</th>
            <th scope="col">{{ __('car.driver') }}</th>
          </tr>
        </thead>
        <tbody>
            @foreach($autopark->cars as $car)
            <tr>
                <td>{{ $car->number }}</td>
                <td>{{ $car->driver }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection

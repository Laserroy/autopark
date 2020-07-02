@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1><i class="fas fa-car"></i> {{ $car->number }}</h1>
    <p>{{ $car->driver }}</p>
    <table class="table w-50 mx-auto">
        <thead class="thead-light">
          <tr>
            <th scope="col">{{ 'autopark.autoparks' }}</th>
          </tr>
        </thead>
        <tbody>
            @foreach($car->autoparks as $autopark)
            <tr>
                <td><i class="far fa-building"></i> {{ $autopark->name }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection

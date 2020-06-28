@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1>{{ $autopark->name }}</h1>
    <p>{{ $autopark->address }}</p>
    <p>{{ $autopark->work_hours }}</p>
    <table class="table w-50 mx-auto">
        <thead class="thead-light">
          <tr>
            <th scope="col">Number</th>
            <th scope="col">Driver</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                @foreach($autopark->cars as $car)
                <td>{{ $car->number }}</td>
                <td>{{ $car->driver }}</td>
                @endforeach
            </tr>
        </tbody>
      </table>
</div>
@endsection

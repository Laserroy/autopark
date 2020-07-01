@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1><i class="fas fa-car"></i> {{ $car->number }}</h1>
    <p>{{ $car->driver }}</p>
    <table class="table w-50 mx-auto">
        <thead class="thead-light">
          <tr>
            <th scope="col">Autoparks</th>
          </tr>
        </thead>
        <tbody>
            @foreach($car->autoparks as $autopark)
            <tr>
                <td><a href="{{ route('manager.autoparks.show', $autopark) }}"><i class="far fa-building"></i> {{ $autopark->name }}</a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection

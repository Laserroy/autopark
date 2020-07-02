@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <table class="table">
        <thead>
          <tr>
            <th>{{ 'car.number' }}</th>
            <th>{{ 'autopark.autoparks' }}</th>
            <th>
                <a type="button" class="btn btn-primary" href="{{ route('cars.create') }}">
                    <i class="fas fa-plus"></i>
                    {{ 'car.new_car' }}
                </a>
            </th>
          </tr>
        </thead>
        <tbody>
        @foreach($cars as $car)
            <tr>
                <td>
                    <i class="fas fa-car" aria-hidden="true"></i>
                    {{ $car->number }}
                </td>
                <td>
                    <ul class="list-group">
                        @foreach($car->autoparks as $autopark)
                        <li class="list-group-item">
                            <i class="far fa-building"></i>
                            {{ $autopark->name }}
                        </li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a type="button" class="btn btn-info text-light" href="{{ route('cars.show', $car) }}"><i class="fas fa-eye"></i></a>
                        <a type="button" class="btn btn-warning text-light" href="{{ route('cars.edit', $car) }}"><i class="fas fa-edit"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
      </table>
</div>
@endsection

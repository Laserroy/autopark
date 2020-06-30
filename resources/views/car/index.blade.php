@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">Number</th>
            <th scope="col">Autoparks</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($cars as $car)
            <tr>
                <td><a href="{{ route('cars.show', $car) }}">{{ $car->number }}</a></td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        show autoparks
                      </button>
                      <div class="dropdown-menu">
                        @foreach($car->autoparks as $autopark)
                        <a class="dropdown-item" href="{{ route('autoparks.show', $autopark) }}"><i class="far fa-building"></i>
                            {{ $autopark->name }}
                        </a>
                        @endforeach
                      </div>
                </td>
                <td>@mdo</td>
            </tr>
        @endforeach
        </tbody>
      </table>
</div>
@endsection

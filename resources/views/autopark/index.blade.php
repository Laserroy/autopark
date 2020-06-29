@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Cars</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($autoparks as $autopark)
            <tr>
                <td><a href="{{ route('autoparks.show', $autopark) }}">{{ $autopark->name }}</a></td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        show cars
                      </button>
                      <div class="dropdown-menu">
                        @foreach($autopark->cars as $car)
                        <a class="dropdown-item" href="{{ route('cars.show', $car) }}"><i class="fas fa-car"></i>
                            {{ $car->number }}
                        </a>
                        @endforeach
                      </div>
                </td>
                <td><a type="button" class="btn btn-warning" href="{{ route('autoparks.edit', $autopark) }}">edit</a></td>
            </tr>
        @endforeach
        </tbody>
      </table>
</div>
@endsection

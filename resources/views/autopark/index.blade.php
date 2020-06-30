@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <table class="table .table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Cars</th>
            <th>
                <a type="button" class="btn btn-primary" href="{{ route('autoparks.create') }}">
                    <i class="fas fa-plus"></i>
                    Add new autopark
                </a>
            </th>
          </tr>
        </thead>
        <tbody>
        @foreach($autoparks as $autopark)
            <tr>
                <td>{{ $autopark->name }}</td>
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
                <td>
                    <div class="btn-group" role="group">
                        <a type="button" class="btn btn-info text-light" href="{{ route('autoparks.show', $autopark) }}"><i class="fas fa-eye"></i></a>
                        <a type="button" class="btn btn-warning text-light" href="{{ route('autoparks.edit', $autopark) }}"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('autoparks.destroy', $autopark)}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{route('autoparks.destroy', $autopark)}}"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
      </table>
</div>
@endsection

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
            <th>{{ __('car.number') }}</th>
            <th>{{ __('autopark.autoparks') }}</th>
            <th>
                <a type="button" class="btn btn-primary" href="{{ route('manager.cars.create') }}">
                    <i class="fas fa-plus"></i>
                    {{ __('car.new_car') }}
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
                        <a type="button" class="btn btn-info text-light" href="{{ route('manager.cars.show', $car) }}"><i class="fas fa-eye"></i></a>
                        <a type="button" class="btn btn-warning text-light" href="{{ route('manager.cars.edit', $car) }}"><i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{route('manager.cars.destroy', $car)}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm({{json_encode(__('app.sure'))}})" href="{{route('manager.cars.destroy', $car)}}"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
      </table>
</div>
@endsection

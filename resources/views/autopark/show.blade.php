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
            @foreach($autopark->cars as $car)
            <tr>
                <td>{{ $car->number }}</td>
                <td>{{ $car->driver }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
      <form method="POST" action="{{route('autoparks.destroy', $autopark)}}">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{route('autoparks.destroy', $autopark)}}"><i class="fa fa-trash"></i></button>
      </form>
</div>
@endsection

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
                    <ul>
                        @foreach($autopark->cars as $car)
                        <li>{{$car->number}}|{{$car->driver}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>@mdo</td>
            </tr>
        @endforeach
        </tbody>
      </table>
</div>
@endsection

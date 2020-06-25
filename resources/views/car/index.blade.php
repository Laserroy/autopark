@extends('layouts.app')

@section('content')
<div>
    <table>
        <th>Number</th>
        <th>Driver</th>
        @foreach($cars as $car)
        <tr>
            <td>{{ $car->number }}</td>
            <td>{{ $car->driver }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection

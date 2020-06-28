@extends('layouts.app')

@section('content')
<div>
    <table>
        <tr>
            <td>Name</td>
            <td>{{ $autopark->name }}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{ $autopark->address }}</td>
        </tr>
        <tr>
            <td>Hours</td>
            <td>{{ $autopark->work_hours }}</td>
        </tr>
        <tr>
            <td>Cars</td>
            @foreach($autopark->cars as $car)
            <td>|{{ $car->number }}----{{ $car->driver }}|</td>
            @endforeach
        </tr>
    </table>
</div>
@endsection

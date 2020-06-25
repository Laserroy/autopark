@extends('layouts.app')

@section('content')
<div>
    <table>
        <th>Name</th>
        <th>Adress</th>
        @foreach($autoparks as $autopark)
        <tr>
            <td>{{ $autopark->name }}</td>
            <td>{{ $autopark->adress }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection

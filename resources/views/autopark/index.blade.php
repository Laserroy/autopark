@extends('layouts.app')

@section('content')
<div>
    <table>
        <th>Name</th>
        <th>Address</th>
        @foreach($autoparks as $autopark)
        <tr>
            <td>
                <a href="{{ route('autoparks.show', $autopark) }}">{{ $autopark->name }}</a>
            </td>
            <td>{{ $autopark->address }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection

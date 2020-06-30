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
            <th>Autoparks</th>
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
                <td>
                    <i class="far fa-building"></i>
                    {{ $autopark->name }}
                </td>
                <td>
                    <ul class="list-group">
                        @foreach($autopark->cars as $car)
                        <li class="list-group-item">
                            <i class="fas fa-car"></i>
                            {{ $car->number }}
                        </li>
                        @endforeach
                    </ul>
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

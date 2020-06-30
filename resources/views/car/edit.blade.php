@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('cars.update', $car) }}">
                @csrf
                @method('PATCH')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1>Car</h1>
                <p>{{ $car->number }}</p>
                <div class="form-group">
                  <label for="carNumber">Number</label>
                  <input type="text" name="number" value="{{ old('number') ?? $car->number }}" class="form-control" aria-describedby="nameHelp" placeholder="Enter car number">
                </div>
                <div class="form-group">
                    <label for="carDriver">Driver</label>
                    <input type="text" name="driver" value="{{ old('driver') ?? $car->driver }}" class="form-control" aria-describedby="addressHelp" placeholder="Enter driver`s name">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="far fa-save"></i></i>
                    Save</button>
            </form>
        </div>
    </div>
</div>
@endsection

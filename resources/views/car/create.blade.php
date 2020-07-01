@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('cars.store') }}">
                @csrf
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
                <div class="form-group">
                  <label for="carNumber">Number</label>
                  <input type="text" name="number" value="{{ old('number') }}" class="form-control" aria-describedby="nameHelp" placeholder="Enter car number">
                </div>
                <div class="form-group">
                    <label for="carDriver">Driver</label>
                    <input type="text" name="driver" value="{{ old('driver') }}" class="form-control" aria-describedby="addressHelp" placeholder="Enter driver`s name">
                </div>
                <div class="form-group">
                    <label for="autoparkSelect">Attach autopark to car by Ctrl+click</label>
                    <select multiple size="10" name="autoparks[]" class="form-control selectpicker" id="autoparkSelect">
                        @foreach(App\Autopark::all() as $autopark)
                        <option value="{{ $autopark->id }}">{{ $autopark->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="far fa-save"></i></i>
                    Create</button>
            </form>
        </div>
    </div>
</div>
@endsection

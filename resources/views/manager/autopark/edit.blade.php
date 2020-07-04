@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('manager.autoparks.update', $autopark) }}">
                @method('PATCH')
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
                <h1>{{ __('autopark.autopark') }}</h1>
                <div class="form-group">
                  <label for="autoparkName">{{ __('autopark.name') }}</label>
                  <input type="text" name="name" value="{{ $autopark->name }}" class="form-control" id="autoparkName" aria-describedby="nameHelp">
                </div>
                <div class="form-group">
                    <label for="autoparkAddress">{{ __('autopark.address') }}</label>
                    <input type="text" name="address" value="{{ $autopark->address }}" class="form-control" id="autoparkAddress" aria-describedby="addressHelp">
                </div>
                <div class="form-group">
                    <label for="autoparkHours">{{ __('autopark.hours') }}</label>
                    <input type="text" name="hours" value="{{ $autopark->work_hours }}" class="form-control" id="autoparkHours" aria-describedby="hoursHelp">
                </div>
                <h3>{{ __('car.cars') }}</h3>
                @foreach($autopark->cars as $car)
                <div class="form-group carInput">
                    <div class="row">
                        <div class="col">
                            <label for="carNumber">{{ __('car.number') }}</label>
                            <input type="text" name="updatedCars[{{ $loop->index }}][number]" value="{{ $car->number }}" class="form-control" id="carNumber" aria-describedby="numberHelp">
                            <input type="hidden" name="updatedCars[{{ $loop->index }}][id]" value="{{ $car->id }}">
                        </div>
                        <div class="col">
                            <label for="carDriver">{{ __('car.driver') }}</label>
                            <input type="text" name="updatedCars[{{ $loop->index }}][driver]" value="{{ $car->driver }}" class="form-control" id="carDriver" aria-describedby="driverHelp">
                        </div>
                    </div>
                </div>
                @endforeach
                <button type="button" id="addNewCarField" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>
                </button>
                <button type="button" id="removeNewCarField" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i>
                </button>
                <button type="submit" class="btn btn-primary float-right">
                    {{ __('autopark.save') }}
                </button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    let counter = $('.carInput').length > 0 ? $('.carInput').length : 0;

    $("#addNewCarField").click(function () {
        let newInputField = '<div class="form-group carInput">'+
                    '<div class="row">'+
                        '<div class="col">'+
                            '<label for="carNumber">{{__('car.number')}}</label>'+
                            `<input type="text" name="newCars[${counter}][number]" class="form-control" id="carNumber" aria-describedby="numberHelp">`+
                        '</div>'+
                        '<div class="col">'+
                            '<label for="carDriver">{{__('car.driver')}}</label>'+
                            `<input type="text" name="newCars[${counter}][driver]" class="form-control" id="carDriver" aria-describedby="driverHelp">`+
                        '</div>'+
                    '</div>'+
                '</div>';
        $(newInputField).insertBefore($("#addNewCarField"));
        counter++;
	    });
    $("#removeNewCarField").click(function () {
        if ($('.carInput').length > 0) {
            counter--;
            $('.carInput').last().remove();
        }
	});
</script>
@endsection

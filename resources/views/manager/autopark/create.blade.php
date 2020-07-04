@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('manager.autoparks.store') }}">
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
                  <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="autoparkName" aria-describedby="nameHelp">
                </div>
                <div class="form-group">
                    <label for="autoparkAddress">{{ __('autopark.address') }}</label>
                    <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="autoparkAddress" aria-describedby="addressHelp">
                </div>
                <div class="form-group">
                    <label for="autoparkHours">{{ __('autopark.hours') }}</label>
                    <input type="text" name="hours" value="{{ old('hours') }}" class="form-control" id="autoparkHours" aria-describedby="hoursHelp">
                </div>
                <h3>{{ __('car.cars') }}</h3>
                <button type="button" id="addNewCarField" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>
                </button>
                <button type="button" id="removeNewCarField" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i>
                </button>
                <button type="submit" class="btn btn-primary float-right">
                    {{ __('autopark.save') }}</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    let counter = 0;
    let numberLabel = '<label for="carNumber">{{__('car.number')}}</label>';
    let driverLabel = '<label for="carDriver">{{__('car.driver')}}</label>';
    $("#addNewCarField").click(function () {
        let newInputField = '<div class="form-group carInput">'+
                    '<div class="row">'+
                        '<div class="col">'+
                            `${counter === 0 ? numberLabel : ''}`+
                            `<input type="text" name="cars[${counter}][number]" class="form-control" id="carNumber" aria-describedby="numberHelp">`+
                        '</div>'+
                        '<div class="col">'+
                            `${counter === 0 ? driverLabel : ''}`+
                            `<input type="text" name="cars[${counter}][driver]" class="form-control" id="carDriver" aria-describedby="driverHelp">`+
                        '</div>'+
                    '</div>'+
                '</div>';
        $(newInputField).insertBefore($("#addNewCarField"));
        counter++;
	    });
    $("#removeNewCarField").click(function () {
        if (counter > 0) {
            counter--;
            $('.carInput').last().remove();
        }
	});
</script>
@endsection

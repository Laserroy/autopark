@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="form" method="POST" action="{{ route('manager.autoparks.store') }}">
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
                  <input type="text" name="name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror form-control" id="autoparkName" aria-describedby="nameHelp">
                </div>
                <div class="form-group">
                    <label for="autoparkAddress">{{ __('autopark.address') }}</label>
                    <input type="text"
                           name="address"
                           value="{{ old('address') }}"
                           class="@error('address') is-invalid @enderror form-control"
                           id="autoparkAddress"
                           aria-describedby="addressHelp">
                </div>
                <div class="form-group">
                    <label for="autoparkHours">{{ __('autopark.hours') }}</label>
                    <input type="text"
                           name="hours"
                           value="{{ old('hours') }}"
                           class="@error('hours') is-invalid @enderror form-control"
                           id="autoparkHours"
                           aria-describedby="hoursHelp">
                </div>
                <h3>{{ __('car.cars') }}</h3>
                @if(old('cars'))
                    @foreach(old('cars') as $oldCar)
                    <div class="form-group carInput">
                        <div class="row align-items-end">
                            <div class="col">
                                <label for="carNumber">{{__('car.number')}}</label>
                                <input type="text"
                                       name="cars[{{$loop->index}}][number]"
                                       value="{{ $oldCar['number'] }}"
                                       class="@error('cars.' . $loop->index . '.number') is-invalid @enderror form-control"
                                       aria-describedby="numberHelp">
                            </div>
                            <div class="col">
                                <label for="carDriver">{{__('car.driver')}}</label>
                                <input type="text"
                                       name="cars[{{$loop->index}}][driver]"
                                       value="{{ $oldCar['driver'] }}"
                                       class="@error('cars.' . $loop->index . '.driver') is-invalid @enderror form-control"
                                       aria-describedby="driverHelp">
                            </div>
                            <div class="col">
                                <button type="button" id="{{$loop->index}}" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
                <button type="button" id="addNewCarField" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>
                </button>
                <button type="submit" class="btn btn-primary float-right">
                    {{ __('autopark.save') }}</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    let counter = $(".carInput").length !== 0 ? $(".carInput").length : 0;
    $(window).on('load', function () {
        $(".btn-danger").each(function (index) {
            $("#" + index).on('click', function () {
            $(this).parent().parent().parent().remove();
	        });
        });
    });
    $("#addNewCarField").click(function () {
        counter++;
        let newInputField = `<div class="form-group carInput">
                    <div class="row align-items-end">
                        <div class="col">
                            <label for="carNumber">{{__('car.number')}}</label>
                            <input type="text"
                                    name="cars[${counter}][number]"
                                    class="@error('cars[${counter}][number]') is-invalid @enderror form-control"
                                    aria-describedby="numberHelp">
                        </div>
                        <div class="col">
                            <label for="carDriver">{{__('car.driver')}}</label>
                            <input type="text" name="cars[${counter}][driver]" class="@error('cars[${counter}][driver]') is-invalid @enderror form-control" aria-describedby="driverHelp">
                        </div>
                        <div class="col">
                            <button type="button" id="${counter}" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
        $(newInputField).insertBefore($("#addNewCarField"));

        $("#" + counter).on('click', function () {
            $(this).parent().parent().parent().remove();
            counter--;
	    });
    });
</script>
@endsection

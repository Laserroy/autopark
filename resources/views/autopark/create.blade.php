@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('autoparks.store') }}">
                @csrf
                <h1>Autopark</h1>
                <div class="form-group">
                  <label for="autoparkName">Name</label>
                  <input type="text" name="name" class="form-control" id="autoparkName" aria-describedby="nameHelp" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="autoparkAddress">Address</label>
                    <input type="text" name="address" class="form-control" id="autoparkAddress" aria-describedby="addressHelp" placeholder="Enter address">
                </div>
                <div class="form-group">
                    <label for="autoparkHours">Working hours</label>
                    <input type="text" name="hours" class="form-control" id="autoparkHours" aria-describedby="hoursHelp" placeholder="Enter working time">
                </div>
                <h3>Cars</h3>
                <div class="form-group carInput">
                    <div class="row">
                        <div class="col">
                            <label for="carNumber">Number</label>
                            <input type="text" name="cars[0][number]" class="form-control" id="carNumber" aria-describedby="numberHelp">
                        </div>
                        <div class="col">
                            <label for="carDriver">Driver</label>
                            <input type="text" name="cars[0][driver]" class="form-control" id="carDriver" aria-describedby="driverHelp">
                        </div>
                    </div>
                </div>
                <button type="button" id="addNewCarField">add Car</button>
                <button type="button" id="removeNewCarField">remove Car</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    let counter = 0;

    $("#addNewCarField").click(function () {
        counter++;
        let newInputField = '<div class="form-group carInput">'+
                    '<div class="row">'+
                        '<div class="col">'+
                            '<label for="carNumber">Number</label>'+
                            `<input type="text" name="cars[${counter}][number]" class="form-control" id="carNumber" aria-describedby="numberHelp">`+
                        '</div>'+
                        '<div class="col">'+
                            '<label for="carDriver">Driver</label>'+
                            `<input type="text" name="cars[${counter}][driver]" class="form-control" id="carDriver" aria-describedby="driverHelp">`+
                        '</div>'+
                    '</div>'+
                '</div>';
        $(newInputField).insertAfter($(".carInput").last());
	    });
    $("#removeNewCarField").click(function () {
        if (counter > 0) {
            counter--;
            $('.carInput').last().remove();
        }
	});
</script>
@endsection


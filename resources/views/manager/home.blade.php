@extends('layouts.app')

@section('content')
<div class="card card-image">
    <div class="text-center py-5 px-4">
      <div>
      <h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>{{ Auth::user()->role }}</strong></h2>
        <p class="mx-5 mb-5">
        </p>
      </div>
    </div>
  </div>
@endsection

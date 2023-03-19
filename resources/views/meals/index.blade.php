@extends('layout')

@section('content')
@include('partials._hero')
@include('partials._search')
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
    @if(count($meals) == 0)
    <p>No meals found.</p>
    @endif
    @foreach($meals as $meal)
        <x-meal-card :meal="$meal" />
    @endforeach
</div>    
@endsection

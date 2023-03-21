@extends('layout')

@section('content')
@include('partials._hero')
<div style="width:100%;" class=" mx-4">
    <p>Filter by:</p>
    <div style="width: 20%; display: inline-block;">@include('partials._search_status')</div>
    <div style="width: 20%; display: inline-block;">@include('partials._search_category')</div>
</div>


@include('partials._search')
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
    @if(count($meals) == 0)
    <p>No meals found.</p>
    @endif
    @foreach($meals as $meal)
        <x-meal-card :meal="$meal" />
    @endforeach

<!-- Next and previous page buttons -->
<div class="flex justify-center">
    {{ $meals->appends(request()->input())->links() }}
</div>
<div class="flex justify-right">
    @include('partials._per_page')
</div>
</div>    
@endsection

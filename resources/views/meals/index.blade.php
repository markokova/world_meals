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

<!-- Next and previous page buttons -->
<div class="flex justify-center">
    {{ $meals->appends(request()->input())->links() }}
</div>
<div class="flex justify-right">
    <form action="/">
        <label for="per_page">Meals per page:</label>
        <select name="per_page" id="per_page">
            <option value="8">8</option>
            <option value="12">12</option>
            <option value="20">20</option>
        </select>
            <button
                type="submit"
                class="h-10 w-20 text-white rounded-lg bg-blue-500 hover:bg-blue-600"
            >
                OK
            </button>
    </form>
</div>
</div>    
@endsection

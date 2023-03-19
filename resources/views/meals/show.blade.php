@extends('layout')

@section('content')
@include('partials._search')
<a href="/" class="inline-block text-black ml-4 mb-4"
><i class="fa-solid fa-arrow-left"></i> Back
</a>
<div class="mx-4">
<x-card class="p-10">
    <div
        class="flex flex-col items-center justify-center text-center"
    >
        <img
            class="w-48 mr-6 mb-6"
            src="{{asset('images/donuts.jpeg')}}"
            alt=""
        />

        <h3 class="text-2xl font-bold mb-2">{{$meal->title}}</h3>
        <div class="text-xl mb-4">{{$meal->description}}</div>
        <ul class="flex">
            @foreach($meal->Tags as $tag)
            <li
                class="bg-black text-white rounded-xl px-3 py-1 mr-2"
            >
                <a href="#">{{$tag->title}}</a>
            @endforeach
        </ul>
        <div class="text-lg my-4">
            <i class="fas fa-info-circle"></i> Category: {{$meal->Category->title}}
        </div>
        <div class="text-lg my-4">
            <i class="fas fa-info-circle"></i> Status: {{$meal->status}}
        </div>
        <div class="border border-gray-200 w-full mb-6"></div>
        <div>
            <h3 class="text-3xl font-bold mb-4">
                Meal Ingredients
            </h3>
            <div class="text-lg space-y-6">
                <ul>
                    @foreach($meal->Ingredients as $ingredient)
                        <li>{{$ingredient->title}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
</x-card>
</div>

@endsection
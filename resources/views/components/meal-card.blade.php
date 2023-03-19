@props(['meal'])
<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{asset('images/donuts.jpeg')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl font-bold">
                <a href="/meals/{{$meal->id}}">{{$meal->title}}</a>
            </h3>
            <div class="text-xl mb-4">Description: {{$meal->description}}</div>
            <ul class="flex">
                @foreach($meal->Tags as $tag)
                <li
                    class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                >
                    <a href="/?tag={{$tag->title}}">{{$tag->title}}</a>
                </li>
                @endforeach
            </ul>
            <div class="text-lg mt-4">
                <i class="fas fa-info-circle"></i> Status: {{$meal->status}}
            </div>
        </div>
    </div>
</x-card>
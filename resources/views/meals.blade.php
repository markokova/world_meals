<h1>{{$heading}}</h1>
@if(count($meals) == 0)
    <p>No listings found.</p>
@endif
@foreach($meals as $meal)
<h2>
    <a href="/meals/{{$meal['id']}}">{{$meal['title']}}</a>
</h2>
<p>
    {{$meal['description']}}
</p>
@endforeach

    

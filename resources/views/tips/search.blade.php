@extends('layouts.app')
@section('content')

<h1>Search Results</h1>

@if (count($tips) > 0)

  <p>
  Your search returned {{ count($tips) }} {{ count($tips) != 1 ? " results" : " result" }}.
  </p>

  @foreach ($tips as $tip)

    <h3><a href="/tips/{{ $tip->slug }}">{{ $tip->name }}</a></h3>
    <p>
    Committed to the LaraBrain on {{ $tip->created_at }}
    </p>
    <p>
    {{ $tip->oneline }}
    </p>
    @include('partials._category_buttons', ['categories' => $tip->categories])

  @endforeach

  <div>
  {!! $tips->render() !!}
  </div>

@else
 <p>
  No search results.
</p>
@endif

@endsection
@extends('layouts.app')
@section('content')

<h1>Search Results</h1>

@if (count($legionnaires) > 0)

  <p>
  Your search returned {{ count($legionnaires) }} {{ count($legionnaires) != 1 ? " results" : " result" }}.
  </p>

  @foreach ($legionnaires as $legionnaire)

    <h3><a href="/legionnaires/{{ $legionnaire->slug }}">{{ $legionnaire->name }}</a></h3>
    <p>
    Legionnaire submitted on {{ $legionnaire->created_at }}
    </p>
    <p>
    {{ $legionneer->oneline }}
    </p>
    @include('partials._category_buttons', ['categories' => $legionneer->categories])

  @endforeach

  <div>
  {!! $legionneers->render() !!}
  </div>

@else
 <p>
  No search results.
</p>
@endif

@endsection

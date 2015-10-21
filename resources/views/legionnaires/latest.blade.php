@extends('layouts.app')

@section('title', 'Latest Legionnaires')

@section('content')

<h1>Latest Legionnaires</h1>

@if (count($legionnaires) > 0)

  @foreach ($legionnaires as $legionnaire)

  	<h3><a href="/legionnaires/{{ $legionnaire->slug }}">{{ $legionnaire->name }}</a></h3>
    <p>
    Submitted to Legion Relief by: <a href="/users/{{ $legionnaire->creator->username }}">{{ $legionnaire->creator->username }}</a> at {{ $legionnaire->created_at }}
    </p>
    <p>
    {{ $legionnaire->oneline }}
    </p>
    @include('partials._category_buttons', ['categories' => $legionnaire->categories])
  @endforeach

  <div>
  {!! $legionnaires->render() !!}
  </div>

@else
 <p>
  No legionnaires.
</p>
@endif

@endsection

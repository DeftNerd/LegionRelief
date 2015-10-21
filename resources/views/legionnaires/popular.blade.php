@extends('layouts.app')

@section('title', 'Popular Legionnaires')

@section('content')

<h1>Popular Legionaires</h1>

@if (count($legionnaires) > 0)

  @foreach ($legionnaires as $legionnaire)

    @include('partials._legionnaire_line_item', ['legionnaire' => $legionnaire])

  @endforeach

  <div>
  {!! $legionnaires->render() !!}
  </div>

@else
 <p>
  No popular legionnaires. :-(
</p>
@endif

@endsection

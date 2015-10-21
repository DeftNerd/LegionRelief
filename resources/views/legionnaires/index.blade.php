@extends('layouts.app')
@section('content')

<h1>Legionnaires</h1>

@if (count($legionnaires) > 0)

  @foreach ($legionnaires as $legionnaire)

    @include('partials._legionnaire_line_item', ['legionnaire' => $legionnaire])

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

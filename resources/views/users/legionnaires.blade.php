@extends('layouts.app')
@section('content')

<h1><a href="/users/{{ $user->username }}">{{ $user->username }}</a> Legionnaires</h1>

@if (count($legionnaires) > 0)

  @foreach ($legionnaires as $legionnaire)

    @if ($legionnaire->approved())
      <p>
      <a href="/legionnaires/{{ $legionnaire->slug }}">{{ $legionnaire->name }}</a>
      </p>
    @else

      @if (\Auth::check())

        @if (\Auth::user()->owns($legionnaire->id))

          <p>
          <a href="/legionnaires/{{ $legionnaire->slug }}">{{ $legionnaire->name }}</a> (pending approval)
          </p>

        @endif

      @endif

    @endif

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

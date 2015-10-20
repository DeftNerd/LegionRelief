@extends('layouts.app')
@section('content')

<h1><a href="/users/{{ $user->username }}">{{ $user->username }}</a> Starred Tips</h1>

@if (count($tips) > 0)

  @foreach ($tips as $tip)

    @if ($tip->approved())
      <p>
      <a href="/tips/{{ $tip->slug }}">{{ $tip->name }}</a>
      </p>
    @else

      @if (\Auth::check())

        @if (\Auth::user()->owns($tip->id))

          <p>
          <a href="/tips/{{ $tip->slug }}">{{ $tip->name }}</a> (pending approval)
          </p>

        @endif

      @endif

    @endif

  @endforeach

  <div>
  {!! $tips->render() !!}
  </div>

@else
 <p>
  No tips.
</p>
@endif

@endsection
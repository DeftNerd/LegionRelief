@extends('layouts.app')

@section('title', 'Popular Tips')

@section('content')

<h1>Popular LaraBrain Tips</h1>

@if (count($tips) > 0)

  @foreach ($tips as $tip)

    @include('partials._tip_line_item', ['tip' => $tip])

  @endforeach

  <div>
  {!! $tips->render() !!}
  </div>

@else
 <p>
  No popular tips. :-(
</p>
@endif

@endsection
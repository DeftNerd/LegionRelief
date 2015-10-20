@extends('layouts.app')
@section('content')

<h1>Tips</h1>

@if (count($tips) > 0)

  @foreach ($tips as $tip)

    @include('partials._tip_line_item', ['tip' => $tip])

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
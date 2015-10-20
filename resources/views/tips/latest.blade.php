@extends('layouts.app')

@section('title', 'Latest Tips')

@section('content')

<h1>Latest Laravel Tips</h1>

@if (count($tips) > 0)

  @foreach ($tips as $tip)

  	<h3><a href="/tips/{{ $tip->slug }}">{{ $tip->name }}</a></h3>
    <p>
    Committed to the LaraBrain by: <a href="/users/{{ $tip->creator->username }}">{{ $tip->creator->username }}</a> at {{ $tip->created_at }}
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
  No tips.
</p>
@endif

@endsection
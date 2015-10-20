@extends('layouts.app')

@section('content')
<h1>{{ $category->name }}</h1>

@if (count($tips) > 0)

  @foreach ($tips as $tip)

  	<h3><a href="/tips/{{ $tip->slug }}">{{ $tip->name }}</a></h3>
    <p>
    Committed to the LaraBrain by: <a href="/users/{{ $tip->creator->username }}">{{ $tip->creator->username }}</a> at {{ $tip->created_at }}
    </p>

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
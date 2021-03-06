@extends('layouts.app')

@section('content')
<h1>{{ $category->name }}</h1>

@if (count($legionnaires) > 0)

  @foreach ($legionnaires as $legionnaire)

  	<h3><a href="/legionnaires/{{ $legionnaire->slug }}">{{ $legionnaire->name }}</a></h3>
    <p>
    Submitted to Legion Relief by: <a href="/users/{{ $legionnaire->creator->username }}">{{ $legionnaire->creator->username }}</a> at {{ $legionnaire->created_at }}
    </p>

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

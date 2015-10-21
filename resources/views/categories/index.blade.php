@extends('layouts.app')
@section('content')

<h1>Categories</h1>
<div class="row">
<div class="col-md-12">
  @if (count($categories) > 0)

    @foreach ($categories as $category)

      <h3>
        <a href="/categories/{{ $category->name }}">{{ $category->name }}</a> ({{ $category->legionnaires->count() }} {{ $category->legionnaires->count() == 1 ? "legionnaire" : "legionnaires" }})
      </h3>

      @if ($category->legionnaires->count() > 0)
        Latest: 
        @include('partials._latest_legionnaire', 
        ['legionnaire' => $category->latestLegionnaire()])
      @endif
    @endforeach

  @else
   <p>
    No categories.
  </p>
  @endif
  </div>
</div>
@endsection

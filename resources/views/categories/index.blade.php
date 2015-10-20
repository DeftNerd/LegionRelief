@extends('layouts.app')
@section('content')

<h1>Categories</h1>
<div class="row">
<div class="col-md-12">
  @if (count($categories) > 0)

    @foreach ($categories as $category)

      <h3>
        <a href="/categories/{{ $category->name }}">{{ $category->name }}</a> ({{ $category->tips->count() }} {{ $category->tips->count() == 1 ? "tip" : "tips" }})
      </h3>

      @if ($category->tips->count() > 0)
        Latest: 
        @include('partials._latest_tip', 
        ['tip' => $category->latestTip()])
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
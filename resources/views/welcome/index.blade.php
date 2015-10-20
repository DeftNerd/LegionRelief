@extends('layouts.app')

@section('content')

<div id="search-section" class="section">
  <div class="section-head">Search the LaraBrain</div>
  {!! Form::open(
    [
      'route' => 'search', 
      'method' => 'get', 
      'class' => 'form-inline', 
      'novalidate' => 'novalidate'
    ]
      ) !!}

  <div class="form-group col-md-10" style="padding-left: 0px;">
    {!! Form::text('keywords', null, array('required', 'class'=>'form-control input-lg', 'placeholder'=>'Search keywords', 'style' => 'width: 100%;')) !!}
  </div>

{!! Form::button('<i class="glyphicon glyphicon-search"></i>', array('type' => 'submit', 'class' => 'btn btn-search input-lg'))!!}

</div>

<div id="tips-section" class="section">
  <div class="section-head">The Latest LaraBrain Tips</div>

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

</div> 
<!-- END tips-section div -->

@endsection

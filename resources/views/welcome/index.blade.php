@extends('layouts.app')

@section('content')

<div id="search-section" class="section">
  <div class="section-head">Search the Legionnaires</div>
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

<div id="legionnaires-section" class="section">
  <div class="section-head">The Latest Legion Relief Legionnaires</div>

  @if (count($legionnaires) > 0)

    @foreach ($legionnaires as $legionnaire)

      @include('partials._legionnaire_line_item', ['legionnaire' => $legionnaire])

    @endforeach

    <div>
    {!! $legionnaires->render() !!}
    </div>

    @else
     <p>
      No legionnaires.
    </p>
    @endif

</div> 
<!-- END legionnaires-section div -->

@endsection

@extends('layouts.app')

@section('header')
  <script src="/js/legionnaires.edit.js"></script>
@endsection

@section('content')

<h1>Edit a Legionnaire</h1>

{!! Form::model($legionnaire,[
  'route'     => ['legionnaires.update', $legionnaire->id], 
  'method'     => 'put',
  'id'         => 'legionnaire-form', 
  'class'      => 'form', 
  'novalidate' => 'novalidate']
  ) !!}

  {!! Form::hidden('categories', 
      $legionnaire->categories->implode('id', ','), 
      ['id' => 'category-field']) 
  !!}

  <div class="form-group">
      {!! Form::label('Title') !!}
      {!! Form::text('name', null, 
      [
        'required', 
        'class' => 'form-control', 
        'placeholder' => 'Please choose a descriptive title'
      ]) !!}
  </div>

  <div class="form-group">
      {!! Form::label('One-line Description') !!}
      {!! Form::text('oneline', null, 
        [
          'required', 
          'class' => 'form-control', 
          'placeholder' => 'Please provide a succinct (less than 250 characters) description of the problem this legionnaire solves'
        ]) !!}
  </div>

  <div class="form-group">
      {!! Form::label('The Legionnaire') !!}
      <span class="pull-right"><a href="#" data-toggle="popover" title="Supported Markdown" data-placement="bottom" data-content="Hyperlinks, italicization, bolding, preformatted text, and code are supported. Headers, lists, images, tables, and other tags are not supported. Search for a Markdown tutorial if you're not familiar with this fantastic formatting syntax.">Supported Tags</a></span>
      {!! Form::textarea('description', null, 
        ['required', 
         'id' => 'description', 
         'class' => 'form-control', 
         'placeholder' => 'Please use Markdown syntax to format your legionnaire. Click the above Supported Tags link to learn more about supported syntax.'
        ]) !!}
  </div>

  <div class="form-group">
      {!! Form::label('Categories (Select a maximum of three)') !!}<br />

      @foreach ($categories as $category)

      <span 
        data-id="{{ $category->id }}" 
        class="category-label category-selector label label-default" 
        style="float: left; font-size: .90em; line-height: 2; margin: 5px;">
          {{ $category->name }}
      </span>

      @endforeach

  </div>
<br clear="all" /><br />
  <div class="form-group">
    {!! Form::submit('Edit Legionnaire', array('class'=>'btn btn-primary')) !!}
  </div>

  {!! Form::close() !!}



@endsection

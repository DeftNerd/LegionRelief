@extends('layouts.app')

@section('header')
  <script src="/js/legionnaires.create.js"></script>
@endsection

@section('content')

<h1>Submit a Legionnaire</h1>

{!! Form::open([
  'route' => 'legionnaires.store', 
  'id' => 'legionnaire-form', 
  'class' => 'form', 
  'novalidate' => 'novalidate']
  ) !!}

  {!! Form::hidden('categories', null, ['id' => 'category-field']) !!}

  <div class="form-group">
      {!! Form::label('name', 'Name') !!}
      {!! Form::text('name', null, 
      [
        'required', 
        'class' => 'form-control', 
        'placeholder' => 'Please enter the legionnaires real name',
        'id' => 'name'
      ]) !!}
  </div>

  <div class="form-group">
      {!! Form::label('handle', 'Handles & Nicknames') !!}
      {!! Form::text('handle', null, 
      [
        'required', 
        'class' => 'form-control', 
        'placeholder' => 'Please enter any nicknames or online handles',
        'id' => 'handle'
      ]) !!}
  </div>

  <div class="form-group">
      {!! Form::label('oneline', 'One-line Description') !!}
      {!! Form::text('oneline', null, 
        [
          'required', 
          'class' => 'form-control', 
          'placeholder' => 'Please provide a succinct (less than 250 characters) description of what happened to this hacker'
        ]) !!}
  </div>

  <div class="form-group">
      {!! Form::label('description', 'Full Story') !!}
      <span class="pull-right"><a href="#" data-toggle="popover" title="Supported Markdown" data-placement="bottom" data-content="Hyperlinks, italicization, bolding, preformatted text, and code are supported. Headers, lists, images, tables, and other tags are not supported. Search for a Markdown tutorial if you're not familiar with this fantastic formatting syntax.">Supported Tags</a></span>
      {!! Form::textarea('description', null, 
        ['required', 
         'id' => 'description', 
         'class' => 'form-control', 
         'placeholder' => 'Please use Markdown syntax to format your story.'
        ]) !!}
  </div>

  <div class="form-group">
      {!! Form::label('address', 'Mailing Address') !!}
      {!! Form::textarea('address', null, 
        ['required', 
         'id' => 'address', 
         'class' => 'form-control', 
         'placeholder' => 'Current Mailing Address'
        ]) !!}
  </div>

  <div class="form-group">
      {!! Form::label('contact', 'Other Contact Methods') !!}
      {!! Form::textarea('contact', null, 
        ['required', 
         'id' => 'contact', 
         'class' => 'form-control', 
         'placeholder' => 'Other contact methods'
        ]) !!}
  </div>

  <div class="form-group">
      {!! Form::label('charges', 'Charges levied against the Legionnaire') !!}
      {!! Form::textarea('charges', null, 
        ['required', 
         'id' => 'charges', 
         'class' => 'form-control', 
         'placeholder' => 'Please list all charges originally thrown at the legionnaire, even if they were eventually dropped. '
        ]) !!}
  </div>

  <div class="form-group">
      {!! Form::label('sentences', 'Sentences given to the Legionnaire') !!}
      {!! Form::textarea('sentences', null, 
        ['required', 
         'id' => 'sentences', 
         'class' => 'form-control', 
         'placeholder' => 'Please list all the charges the Legionnaire was found guilty of and what the punishment was'
        ]) !!}
  </div>

  <div class="form-group">
      {!! Form::label('status', 'Status of the Legionnaires situation') !!}
      {!! Form::textarea('status', null, 
        ['required', 
         'id' => 'status', 
         'class' => 'form-control', 
         'placeholder' => 'How is the legionnaire doing? How are they handling things in prison? Are they up for parole anytime soon?'
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
    {!! Form::submit('Submit Legionnaire', array('class'=>'btn btn-info')) !!}
  </div>

  {!! Form::close() !!}

@endsection

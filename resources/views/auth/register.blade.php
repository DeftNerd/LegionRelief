@extends('layouts.accounts')

@section('title', 'Create a LegionRelief account')

@section('content')
<div class="col-md-6 col-md-offset-3">

{!! Form::open(['url' => '/register', 'class' => 'form']) !!}

<h1>Create a LegionRelief Account</h1>

<div class="form-group">
    {!! Form::label('name', 'Your Name') !!}
    {!! Form::text('name', null, 
      [
       'class'=>'form-control', 
       'placeholder'=>'Name'
      ]
    ) !!}
</div>

<div class="form-group">
    {!! Form::label('username', 'Your Username') !!}
    {!! Form::text('username', null, 
     [
      'class'=>'form-control', 
      'placeholder'=>'Username'
     ]
    ) !!}
</div>

<div class="form-group">
    {!! Form::label('Your E-mail Address') !!}
    {!! Form::text('email', null, 
      [
      'class'=>'form-control', 
      'placeholder'=>'Email Address'
      ]) !!}
</div>
<div class="form-group">
    {!! Form::label('Your Password') !!}
    {!! Form::password('password', 
      [
       'class'=>'form-control', 
       'placeholder'=>'Password (at least 6 characters)'
       ]) !!}
</div>
<div class="form-group">
    {!! Form::label('Confirm Password') !!}
    {!! Form::password('password_confirmation', 
      [
        'class'=>'form-control', 
        'placeholder'=>'Confirm Password'
      ])
    !!}
</div>

<div class="form-group">
    {!! Form::submit('Create My Account!', 
      ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
</div>

@endsection

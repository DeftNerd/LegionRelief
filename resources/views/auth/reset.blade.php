@extends('layouts.accounts')

@section('title', 'Recover Your Password')

@section('content')
<div class="col-md-6 col-md-offset-3">

    <h1>Reset Your LaraBrain Password</h1>

    {!! Form::open(
    	[
    	 'url'    => '/password/reset', 
    	 'class'  => 'form', 
    	 'method' => 'post'
    	]
    	) !!}

    {!! Form::hidden('token', $token) !!}

    <div class="form-group">
      {!! Form::label('email', 'Your E-mail Address') !!}
      {!! Form::text('email', null, 
        [
         'class'       => 'form-control', 
         'placeholder' => 'nerd@larabrain.com'
        ]) !!}
    </div>

    <div class="form-group">
      {!! Form::label('password', 'New Password') !!}
      {!! Form::password('password',
        [
         'class'       => 'form-control', 
         'placeholder' => 'New Password'
        ]) !!}
    </div>

    <div class="form-group">
      {!! Form::label('password_confirmation', 'Confirm Password') !!}
      {!! Form::password('password_confirmation', 
        [
          'class'       => 'form-control', 
          'placeholder' => 'Confirm Password'
        ]) !!}
    </div>

    <div class="form-group">
      {!! Form::submit('Reset password', 
        [
         'class' => 'btn btn-primary'
        ]) !!}
    </div>

    {!! Form::close() !!}

</div>

@endsection

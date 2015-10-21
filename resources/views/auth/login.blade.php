@extends('layouts.accounts')

@section('title', 'Sign in to your LegionRelief account')

@section('content')
<div class="col-md-6 col-md-offset-3">

{!! Form::open(
  [
   'url' => '/login', 
   'class' => 'form'
  ]
) !!}

  <h1>Sign In to Your LegionRelief Account</h1>

  <div class="form-group">
    {!! Form::label('email', 'Your E-mail Address') !!}
    {!! Form::text('email', null, 
      [
        'class'       => 'form-control', 
        'placeholder' => 'E-mail'
      ]
    ) !!}
  </div>

  <div class="form-group">
    {!! Form::label('Your Password') !!}
    {!! Form::password('password', 
      [
        'class'       => 'form-control', 
        'placeholder' => 'Password'
      ]
    ) !!}
  </div>

  <div class="form-group">
    <label>
      {!! Form::checkbox('remember', 'remember') !!} Remember Me
    </label>
  </div>

  <div class="form-group">
    {!! Form::submit('Login', ['class'=>'btn btn-primary']) !!}
  </div>

  <a href="/password/email">Forgot Your Password?</a>
{!! Form::close() !!}
</div>

@endsection

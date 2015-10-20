@extends('layouts.accounts')

@section('title', 'Recover Your Password')

@section('content')
<div class="col-md-6 col-md-offset-3">

    {!! Form::open(['url' => '/password/email', 'class' => 'form']) !!}

    <h1>Recover Your Password</h1>

    <div class="form-group">
      {!! Form::label('email', 'Your E-mail Address') !!}
      {!! Form::text('email', null, 
        ['class'=>'form-control', 'placeholder'=>'E-mail']) !!}
    </div>

    <div class="form-group">
      {!! Form::submit('E-mail Password Recovery Link', 
        ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

</div>

@endsection
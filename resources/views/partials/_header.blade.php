<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to the LaraBrain - @yield('title')</title>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

  <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  @yield('header')
  <link href="/css/app.css" rel="stylesheet">

<link href='https://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css'>

<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">

</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

<div class="container-fluid" id="top-bar">
  <div class="container">
    <div class="row">
      <div id="top-offer" class="col-sm-7 float-left">
        Purchase <b>all</b> of the LaraBrain source code and a companion development guide for just $49! {!! link_to_route('about.buy', 'Learn more', []) !!}.
      </div>
      <div class="col-sm-5">
        <div class="top-offer-links pull-right">
          <a class="offer-link" href="/about">About</a>
          <a class="offer-link" href="/contact">Contact</a>
          <a class="offer-link" href="/books">Books</a>
          <a class="offer-link" href="/buy">Purchase</a>

          @if(! Auth::check())
            <a class="offer-link" href="/register">Create Account</a>
            <a class="offer-link" href="/login">Sign In</a>
          @else
            
            <a class="offer-link" href="/logout">Sign Out</a>

            @if (Auth::User()->isAdmin())
              <a class="offer-link" href="/admin/">Administration</a>
            @endif

          @endif

        </div>
      </div>
    </div>
  </div>

  <div id="main-nav" class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/"><img class="logo" src="/images/logo.png" /></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/categories">Categories</a></li>
        <li><a href="/tips/popular">Popular</a></li>
        <li><a href="/tips/new">Latest</a></li>
        <li>
        <a href="/tips/create" id="tip-submit" class="btn btn-tip">
          <span class="glyphicon glyphicon-search"></span>
          Submit a Tip
        </a>
        </li>

        @if(Auth::check())
          <li><a href="/users/{{ Auth::user()->slug }}">
          Hi, {{ Auth::user()->name }}</a>
          </li>
        @endif
      </ul>
    </div>

  </div>
</nav>


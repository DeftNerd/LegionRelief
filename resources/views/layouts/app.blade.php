@include('partials._header')

<div class="container" style="padding-left: 20px; padding-right: 0px;">

  <div class="row">
    <div class="col-md-8" id="main">

      @if(Session::has('message') || Session::has('status'))
        <div class="alert alert-info">
          @if(Session::has('message'))
            {{ Session::get('message') }}
          @endif
          @if(Session::has('status'))
            {{ Session::get('status') }}
          @endif
        </div>
      @endif

      @if (count($errors) > 0)
        <div class="alert alert-danger">
          Please correct the following errors:<br />
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @yield('content')
    </div>

    <div class="col-md-4 section" id="sidebar">

    @yield('sidebar')

    <div class="subsection">
      <div class="section-head">Recently Updated Categories</div>
      @include('partials._category_buttons', 
        ['categories' => App\Category::active()])
    </div>
    
    <div class="subsection">
      <div class="section-head">Recently Starred Tips</div>
      <ul class="content-list">
        @foreach (App\Tip::starred()
                  ->orderBy('created_at', 'desc')->take(5)->get() as $tip)

          <li>
          <i class="glyphicon glyphicon-star"></i>
          <a href="/tips/{{ $tip->slug }}">
          {{ $tip->name }}
          </a>
          </li>

        @endforeach
      </ul>

    </div>
    
    <div class="subsection">
      <div class="section-head">Recently Submitted Tips</div>
      <ul class="content-list">
        @foreach (App\Tip::orderBy('created_at', 'desc')->take(5)->get() as $tip)

          <li>
          <i class="glyphicon glyphicon-paperclip"></i>
          <a href="/tips/{{ $tip->slug }}">
          {{ $tip->name }}
          </a>
          </li>

        @endforeach
      </ul>

    </div>

    <div class="section-head">Recently Active Users</div>
    <ul class="content-list">

      @foreach(App\User::active()->take(5) as $user)

        <li>
          <i class="glyphicon glyphicon-user"></i>
          <a href="/users/{{ $user->username }}">
          {{ $user->username }}</a>
        </li>

      @endforeach

      </ul>

    </div>
  </div>

</div>

@include('partials._footer')


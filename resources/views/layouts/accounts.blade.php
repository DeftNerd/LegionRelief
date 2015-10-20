@include('partials._header')

  <div class="container" style="padding-left: 0px; padding-right: 0px;">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">

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

      </div>
    </div>

    <div class="row">
        @yield('content')
    </div>

  </div>

@include('partials._footer')


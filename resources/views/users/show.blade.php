@extends('layouts.app')

@section('content')
<h1>{{ $user->username }}</h1>

<h2>Recently Submitted Tips</h2>

@if ($user->tips->count() > 0)

	@foreach ($user->tips()->withUnapproved()->get() as $tip)

	@if ($tip->approved())
		<p>
		<a href="/tips/{{ $tip->slug }}">{{ $tip->name }}</a>
		</p>
	@else

		@if (\Auth::check())

			@if (\Auth::user()->owns($tip->id))

				<p>
				<a href="/tips/{{ $tip->slug }}">{{ $tip->name }}</a> (pending approval)
				</p>

			@endif

		@endif

	@endif

	@endforeach

	<p>
	<a class="btn btn-info" href="/users/{{ $user->username }}/tips/">View all submitted tips</a>
	</p>

@else

	<p>
	No submitted tips.
	</p>

@endif

<h2>Recently Starred Tips</h2>

@if ($user->stars->count() > 0)

	@foreach ($user->stars as $star)

	<p>
	<a href="/tips/{{ $star->slug }}">{{ $star->name }}</a>
	</p>

	@endforeach

	<p>
	<a class="btn btn-info" href="/users/{{ $user->username }}/stars/">View all starred tips</a>
	</p>

@else

	<p>
	No starred tips.
	</p>

@endif

@endsection
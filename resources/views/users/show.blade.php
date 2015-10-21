@extends('layouts.app')

@section('content')
<h1>{{ $user->username }}</h1>

<h2>Recently Submitted Legionnairs</h2>

@if ($user->legionnaires->count() > 0)

	@foreach ($user->legionnaires()->withUnapproved()->get() as $legionnaire)

	@if ($legionnaire->approved())
		<p>
		<a href="/legionnaires/{{ $legionnaire->slug }}">{{ $legionnaire->name }}</a>
		</p>
	@else

		@if (\Auth::check())

			@if (\Auth::user()->owns($legionnaire->id))

				<p>
				<a href="/legionnaires/{{ $legionnaire->slug }}">{{ $legionnaire->name }}</a> (pending approval)
				</p>

			@endif

		@endif

	@endif

	@endforeach

	<p>
	<a class="btn btn-info" href="/users/{{ $user->username }}/legionnaires/">View all submitted legionnaires</a>
	</p>

@else

	<p>
	No submitted legionnaires.
	</p>

@endif

<h2>Recently Starred Legionnaires</h2>

@if ($user->stars->count() > 0)

	@foreach ($user->stars as $star)

	<p>
	<a href="/legionnaires/{{ $star->slug }}">{{ $star->name }}</a>
	</p>

	@endforeach

	<p>
	<a class="btn btn-info" href="/users/{{ $user->username }}/stars/">View all starred legionnaires</a>
	</p>

@else

	<p>
	No starred legionnaires.
	</p>

@endif

@endsection

<h3>
	{!! link_to_route(
		'legionnaires.show', 
		$legionnaire->name, 
		[$legionnaire->slug]
		) 
	!!}
</h3>
<p>
{{ $legionnaire->oneline }}
</p>

<p>
	Submitted to Legion Relief by:
	<a href="/users/{{ $legionnaire->creator->slug }}">
		{{ $legionnaire->creator->slug }}
	</a>
	at {{ $legionnaire->created_at }}
</p>

@include('partials._category_buttons', 
	['categories' => $legionnaire->categories])

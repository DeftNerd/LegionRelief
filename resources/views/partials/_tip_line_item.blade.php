<h3>
	{!! link_to_route(
		'tips.show', 
		$tip->name, 
		[$tip->slug]
		) 
	!!}
</h3>
<p>
{{ $tip->oneline }}
</p>

<p>
	Committed to the LaraBrain by:
	<a href="/users/{{ $tip->creator->slug }}">
		{{ $tip->creator->slug }}
	</a>
	at {{ $tip->created_at }}
</p>

@include('partials._category_buttons', 
	['categories' => $tip->categories])
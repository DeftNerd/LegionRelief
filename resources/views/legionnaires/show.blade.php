@extends('layouts.app')

@section('title', $legionnaire->name)

@section('content')
	
	<div class="row">
		<div class="col-md-12">

			@if (! $legionnaire->isApproved())

			<p>
			This legionnaire has not yet been approved. In the meantime, 
			feel free to edit it. Our team will review the legionnaire as soon as possible!
			</p>

			@if (\Auth::user()->isAdmin())

	            {!! Form::open(
	              [
	                'route' => ['admin_legionnaires_approve', $legionnaire->id], 
	                'method' => 'post'
	              ]) !!}
	                <button type="submit" class="btn btn-danger btn-mini">Approve</button>
	            {!! Form::close() !!}
			
			@endif

			@endif

			<h1 style="margin-top: 0px;">
			{{ $legionnaire->name }}
			</h1>
			@include(
				'partials._category_buttons', 
				['categories' => $legionnaire->categories]
			)

			<div class="pull-right">
				@if (Auth::user())
					{!! Form::open(array('route' => 'legionnaires.star', 'id' => 'legionnaire-star', 'class' => 'form')) !!}
						{!! Form::hidden('id', $legionnaire->id) !!}
						<button type="submit" class="btn btn-info btn-xs">
						  @include('partials._star_button', ['id' => $legionnaire->id, 'user' => Auth::user()])
						</button>

						@if (\App\Legionnaire::isEditable($legionnaire->id))
							<a class="btn btn-info btn-xs" href="/legionnaires/{{ $legionnaire->id }}/edit">
							<i id="star" class="glyphicon glyphicon-pencil"></i>
							</a>
						@endif

					{!! Form::close() !!}
				@endif
			</div>

		</div>
	</div>

	@include('partials._committed_by', ['legionnaire' => $legionnaire])

	<p>
	<strong>{{ $legionnaire->oneline }}</strong>
	</p>

	<p>
	{!! $legionnaire->description !!}
	</p>

<script>
  $("#legionnaire-star").submit(function(e) {
  	e.preventDefault();
	$.ajax(
	{
		type: 'POST',
		url: '/legionnaires/star',
		data: $(this).serialize(),
		success: function(data) {
			if (data.outcome == 'starred') {
				$('#star').removeClass('glyphicon-star');
				$('#star').addClass('glyphicon-star-empty');
			} else {
				$('#star').removeClass('glyphicon-star-empty');
				$('#star').addClass('glyphicon-star');	
			}
		}
	});   
  });
</script>
@endsection

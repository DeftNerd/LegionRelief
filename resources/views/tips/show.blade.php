@extends('layouts.app')

@section('title', $tip->name)

@section('content')
	
	<div class="row">
		<div class="col-md-12">

			@if (! $tip->isApproved())

			<p>
			This tip has not yet been approved. In the meantime, 
			feel free to edit it. Our team will review the tip as soon as possible!
			</p>

			@if (\Auth::user()->isAdmin())

	            {!! Form::open(
	              [
	                'route' => ['admin_tips_approve', $tip->id], 
	                'method' => 'post'
	              ]) !!}
	                <button type="submit" class="btn btn-danger btn-mini">Approve</button>
	            {!! Form::close() !!}
			
			@endif

			@endif

			<h1 style="margin-top: 0px;">
			{{ $tip->name }}
			</h1>
			@include(
				'partials._category_buttons', 
				['categories' => $tip->categories]
			)

			<div class="pull-right">
				@if (Auth::user())
					{!! Form::open(array('route' => 'tips.star', 'id' => 'tip-star', 'class' => 'form')) !!}
						{!! Form::hidden('id', $tip->id) !!}
						<button type="submit" class="btn btn-info btn-xs">
						  @include('partials._star_button', ['id' => $tip->id, 'user' => Auth::user()])
						</button>

						@if (\App\Tip::isEditable($tip->id))
							<a class="btn btn-info btn-xs" href="/tips/{{ $tip->id }}/edit">
							<i id="star" class="glyphicon glyphicon-pencil"></i>
							</a>
						@endif

					{!! Form::close() !!}
				@endif
			</div>

		</div>
	</div>

	@include('partials._committed_by', ['tip' => $tip])

	<p>
	<strong>{{ $tip->oneline }}</strong>
	</p>

	<p>
	{!! $tip->description !!}
	</p>

<script>
  $("#tip-star").submit(function(e) {
  	e.preventDefault();
	$.ajax(
	{
		type: 'POST',
		url: '/tips/star',
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
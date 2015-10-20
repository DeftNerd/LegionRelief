@if ($user->stars->contains($id))
	<i id="star" class="glyphicon glyphicon-star"></i><br />
@else
	<i id="star" class="glyphicon glyphicon-star-empty"></i><br />
@endif
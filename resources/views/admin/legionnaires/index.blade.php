@extends('layouts.app')

@section('sidebar')

  @include('admin.partials._stats')

@endsection

@section('content')

<h1>Manage Legionnaires</h1>

@if (count($legionnaires) > 0)

  <table class="table table-striped table-bordered">
  <thead>
  <th>Name</th>
  <th>Creator</th>
  <th>Submitted On</th>
  <th></th>
  </thead>

    @foreach ($legionnaires as $legionnaire)

      <tr>
        <td>
          <a href="/legionnaires/{{ $legionnaire->slug }}">{{ $legionnaire->name }}</a>
        </td>
        <td>
          <a href="/users/{{ $legionnaire->creator->slug }}">{{ $legionnaire->creator->slug }}</a>
        </td>
        <td>
          {{ $legionnaire->created_at }}
        </td>
        <td>
          @if ($legionnaire->isApproved())
            {!! Form::open(
              [
                'route' => ['admin_legionnaires_unapprove', $legionnaire->id], 
                'method' => 'post'
              ]
              ) !!}
                <button type="submit" class="btn btn-danger btn-mini">Unapprove</button>
            {!! Form::close() !!}
          @else
            {!! Form::open(
              [
                'route' => ['admin_legionnaires_approve', $legionnaire->id], 
                'method' => 'post'
              ]) !!}
                <button type="submit" class="btn btn-danger btn-mini">Approve</button>
            {!! Form::close() !!}
          @endif
        </td>
      </tr>

    @endforeach

  </table>

  <div>
  {!! $legionnaires->render() !!}
  </div>

@else
 <p>
  No legionnaires.
</p>
@endif

@endsection

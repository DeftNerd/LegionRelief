@extends('layouts.app')

@section('sidebar')

  @include('admin.partials._stats')

@endsection

@section('content')

<h1>Manage Tips</h1>

@if (count($tips) > 0)

  <table class="table table-striped table-bordered">
  <thead>
  <th>Name</th>
  <th>Creator</th>
  <th>Submitted On</th>
  <th></th>
  </thead>

    @foreach ($tips as $tip)

      <tr>
        <td>
          <a href="/tips/{{ $tip->slug }}">{{ $tip->name }}</a>
        </td>
        <td>
          <a href="/users/{{ $tip->creator->slug }}">{{ $tip->creator->slug }}</a>
        </td>
        <td>
          {{ $tip->created_at }}
        </td>
        <td>
          @if ($tip->isApproved())
            {!! Form::open(
              [
                'route' => ['admin_tips_unapprove', $tip->id], 
                'method' => 'post'
              ]
              ) !!}
                <button type="submit" class="btn btn-danger btn-mini">Unapprove</button>
            {!! Form::close() !!}
          @else
            {!! Form::open(
              [
                'route' => ['admin_tips_approve', $tip->id], 
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
  {!! $tips->render() !!}
  </div>

@else
 <p>
  No tips.
</p>
@endif

@endsection
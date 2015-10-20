@extends('layouts.app')

@section('sidebar')

  @include('partials._stats')

@endsection

@section('content')

<h1>Manage Users</h1>

@if (count($users) > 0)

  <table class="table table-striped table-bordered">
  <thead>
  <th>Name</th>
  <th>E-mail</th>
  <th>Registered On</th>
  </thead>

    @foreach ($users as $user)

      <tr>
        <td><a href="/users/{{ $user->slug }}">{{ $user->name }}</a></td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at }}</td>
      </tr>

    @endforeach

  </table>

  <div>
  {!! $users->render() !!}
  </div>

@else
 <p>
  No users.
</p>
@endif

@endsection
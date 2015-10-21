<h2>LegionRelief Statistics</h2>

<h3>Users</h3>
<p>
Registered users: {{ \App\User::count() }}
</p>

<h3>Legionnaires</h3>
<p>
Legionnaires submitted: {{ \App\Legionnaire::withUnapproved()->count() }}<br />
Legionnaires approved: {{ \App\Legionnaire::count() }}
</p>

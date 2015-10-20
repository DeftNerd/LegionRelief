<h2>LaraBrain Statistics</h2>

<h3>Users</h3>
<p>
Registered users: {{ \App\User::count() }}
</p>

<h3>Tips</h3>
<p>
Tips submitted: {{ \App\Tip::withUnapproved()->count() }}<br />
Tips approved: {{ \App\Tip::count() }}
</p>
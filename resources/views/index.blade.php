<table>
	<thead>
		<th>Name</th>
		<th>Student</th>
		<th>Parent</th>
		<th>Admin</th>
	</thead>
	<tbody>
		@foreach ($users as $user)
		<tr>
			<td>{{ $user->name }}</td>
			<td><input type="checkbox" {{ $user->hasRole('Student') ? 'checked' : '' }}></td>
			<td><input type="checkbox" {{ $user->hasRole('Parent') ? 'checked' : '' }}></td>
			<td><input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }}></td>
		</tr>
		@endforeach

	</tbody>
</table>

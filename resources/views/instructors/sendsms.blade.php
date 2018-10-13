@extends('templates.master')
@section('content')
<p>Instructor SEND SMS</p>
@endsection
	<table id="tables" class="table table-bordered" style="width:100%">
					<thead class="text-center">
						<th>Time</th>
						<th>Days</th>
						<th>Rooms</th>
						<th>Subjects</th>
						<th>Block</th>
						<th>Actions</th>
					</thead>
					<tbody class="text-center">
						@foreach ($schedules as $schedule)
							<tr>
								<td>{{ $schedule->start_time . ' - ' .  $schedule->end_time }}</td>
								<td>{{ $schedule->days }}</td>
								<td>{{ $schedule->room }}</td>
								<td>{{ $schedule->subject }}</td>
								<td>{{ $schedule->block }}</td>
								<td><a class="btn btn-success rounded-0 border-0" href="/instructor/students/{{ $schedule->id }}"><b>View Students</b></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>

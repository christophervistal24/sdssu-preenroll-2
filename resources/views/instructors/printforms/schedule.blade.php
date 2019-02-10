@inject('instructor','App\Instructor')
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>{{ ucwords($user_info->name) }} Schedule</title>
		<style>
			.header-2 {
				font-size:15px;
			}
			.education {
				float:right;
			}

		</style>
	</head>
	<body>
		<div class="header">
			<img src="{{ asset('/storage/img/sdssu.png') }}" style="position:absolute; left :18.7% top :0%">
			<center>Republic of the Philippines</center>
			<center>SURIGAO DEL SUR STATE UNIVERSITY</center>
			<center>Tandag City , Surigao del Sur</center>
			<img src="{{ asset('/storage/img/sdssu-cecst-logo.png') }}" style="position:absolute; z-index: 2; top :0%; left :75%">
		</div>
			<br>
			<center class="header-2"><b>COLLEGE OF ENGINEERING , COMPUTER STUDIES & TECHNOLOGY</b></center>
			<center class="header-2"><b>FACULTY WORKLOAD</b></center>
			<center><b>SY {{ $current_semester->school_year . ' - ' . ($current_semester->school_year+1) }} / {{ digitToWord($current_semester->id) }} SEMESTER</b></center>
			<center class="header-2"><b>Regular load</b></center>
			<br>
			<br>
		</div>
		<span>Name : <b>{{ strtoupper($user_info->name) }}</b></span>
		<span class="education">Educ. Qualifaction : <b> {{ strtoupper($user_info->education_qualification) }}</b></span>
		@php
		$position_of_comma = strpos(ucwords($user_info->created_at->diff(\Carbon\Carbon::now())
		->format('%y years, %m months and %d days')),',');
		@endphp
		<div style="clear:both;">
			<span>Years in service : <b>{{
				substr(ucwords($user_info->created_at->diff(\Carbon\Carbon::now())
				->format('%y years, %m months and %d days')),0,$position_of_comma)
			}}</b></span>
			<span style="float:right; margin-right : 99px;">Major : <b>{{ ucwords($user_info->major) }}</b></span>
		</div>
		<div style="clear:both">
			<span>Status : <b>{{ ucwords($user_info->status) }}</b></span>
		</div>
		<br>
		<br>
		<table border="1" style="border-collapse: collapse;" width="100%">
			<thead>
				<tr>
					<th><center>Time & Day</center></th>
					<th><center>Course No.</center></th>
					<th><center>Description</center></th>
					<th><center>Course Year</center></th>
					<th><center>No. of Students</center></th>
					<th><center>Units</center></th>
					<th><center>Room</center></th>
				</tr>
			</thead>
			<tbody>
					@php
					 	$sum = 0;
					 	$checkMW = false;
					 	$checkTTH = false;
					 	$checkS = false;
					@endphp
				@foreach ($instructors as $schedule)
						<tr><td colspan="7"><b>MWF</b></td></tr>
					@foreach ($schedule->schedules as $instructor_sched)
							@if (strtolower($instructor_sched->days) === 'mwf')
								<tr>
									<td style="font-size:15px"><center>{{  $instructor_sched->start_time . ' - ' . $instructor_sched->end_time }}</center></td>
									<td><center>{{ $instructor_sched->subject->sub }}</center></td>
									<td><center>{{ $instructor_sched->subject->sub_description }}</center></td>
									<td><center>
										{{
										$instructor_sched->block_schedule->level .
										$instructor_sched->block_schedule->course .
										$instructor_sched->block_schedule->block_name
										}}
									</center></td>
									<td><center>{{  $no_of_students = $instructor->sched_student($instructor_sched->id) }}</center></td>
									@php $sum += $instructor_sched->subject->units; @endphp
									<td><center>{{ $instructor_sched->subject->units }}</center></td>
									<td><center>{{ $instructor_sched->room }}</center></td>
								</tr>
							@endif

							@if (strtolower($instructor_sched->days) === 'mw')
									@if (!$checkMW)
										<tr><td colspan="7"><b>MW</b></td></tr>
									@endif
								<tr>
									<td style="font-size:15px"><center>{{  $instructor_sched->start_time . ' - ' . $instructor_sched->end_time }}</center></td>
									<td><center>{{ $instructor_sched->subject->sub }}</center></td>
									<td><center>{{ $instructor_sched->subject->sub_description }}</center></td>
									<td><center>
										{{
										$instructor_sched->block_schedule->level .
										$instructor_sched->block_schedule->course .
										$instructor_sched->block_schedule->block_name
										}}
									</center></td>
									<td><center>{{  $no_of_students = $instructor->sched_student($instructor_sched->id) }}</center></td>
									@php $sum += $instructor_sched->subject->units; @endphp
									<td><center>{{ $instructor_sched->subject->units }}</center></td>
									<td><center>{{ $checkMW = $instructor_sched->room }}</center></td>
								</tr>
							@endif

							@if ( strtolower($instructor_sched->days) === 'tth')
									@if (!$checkTTH)
										<tr><td colspan="7"><b>TTH</b></td></tr>
									@endif
								<tr>
									<td style="font-size:15px"><center>{{  $instructor_sched->start_time . ' - ' . $instructor_sched->end_time }}</center></td>
									<td><center>{{ $instructor_sched->subject->sub }}</center></td>
									<td><center>{{ $instructor_sched->subject->sub_description }}</center></td>
									<td><center>
										{{
										$instructor_sched->block_schedule->level .
										$instructor_sched->block_schedule->course .
										$instructor_sched->block_schedule->block_name
										}}
									</center></td>
									<td><center>{{  $no_of_students = $instructor->sched_student($instructor_sched->id) }}</center></td>
									@php $sum += $instructor_sched->subject->units; @endphp
									<td><center>{{ $instructor_sched->subject->units }}</center></td>
									<td><center>{{ $checkTTH = $instructor_sched->room }}</center></td>
								</tr>
							@endif

							@if (strtolower($instructor_sched->days) === 's')
								@if (!$checkS)
										<tr><td colspan="7"><b>S</b></td></tr>
								@endif
								<tr>
									<td style="font-size:15px"><center>{{  $instructor_sched->start_time . ' - ' . $instructor_sched->end_time }}</center></td>
									<td><center>{{ $instructor_sched->subject->sub }}</center></td>
									<td><center>{{ $instructor_sched->subject->sub_description }}</center></td>
									<td><center>
										{{
										$instructor_sched->block_schedule->level .
										$instructor_sched->block_schedule->course .
										$instructor_sched->block_schedule->block_name
										}}
									</center></td>
									<td><center>{{  $no_of_students = $instructor->sched_student($instructor_sched->id) }}</center></td>
									@php $sum += $instructor_sched->subject->units; @endphp
									<td><center>{{ $instructor_sched->subject->units }}</center></td>
									<td><center>{{ $checkS = $instructor_sched->room }}</center></td>
								</tr>
							@endif
					@endforeach
				@endforeach
				@if ($sum != 0)
						<tr>
							<th>No. of Units</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><center>{{ $sum }}</center></th>
							<th></th>
						</tr>
						<tr>
							<th>No. of Preparation</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th>Add Designation</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th>Add Special Assignment</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th>Total no. of Units</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
				@endif
			</tbody>
		</table>
				<div class="first-col">
					<div style="float:left">
							<p>Recommending Approval : </p>
							<p>(NAME HERE)</p>
							<p>Dean , CECST</p>
					</div>
					<div style="float:right; margin-right : 70px">
							<p>Prepared by : </p>
							<p>(NAME HERE)</p>
							<p>Assistant Dean, CECST</p>
					</div>
					<div style="clear:both;"></div>
					<div style="float:left">
							<p>Reviewed by : </p>
							<p>(NAME HERE)</p>
							<p>Director for Curriculum Development</p>
					</div>
					<div style="float:right">
							<p>Confirmed : </p>
							<p>{{ strtoupper( $user_info->name  . ',' . $user_info->education_qualification) }} </p>
							<p>{{ ucwords($user_info->position) }}</p>
					</div>
					<div style="clear:both;"></div>
					<div style="float:left">
							<p>Approved : </p>
							<p>(NAME HERE)</p>
							<p>Vice President for Academemic Affairs</p>
					</div>
				</div>

	</body>
</html>

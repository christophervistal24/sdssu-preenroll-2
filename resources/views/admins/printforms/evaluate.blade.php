@php
       $total_units = 0;
       $semestral = 0;
       $gpa = 0;
       $count = 0;
       $gpa       = array_sum((array_column($s_grades->toArray(),'remarks')));
       $count     = count(array_column($s_grades->toArray(),'subject_id'));
       $semestral = $gpa / $count;
@endphp
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style>
			.sample {
				height : 50px;
				width :auto;
				line-height: 0px;
			}

			table > thead  {
				border-top : 2px solid black;
				border-bottom : 2px solid black;
				text-align: center;
			}

			table > tbody {
				border-bottom : 2px solid black;
			}

			table > tbody > tr > td {
				text-align: center;
			}
		</style>
	</head>
	<body>
		<div class="header">
			<img src="{{ asset('/storage/img/sdssu.png') }}" style="position:absolute; left :18.7% top :0%">
			<center><b>Republic of the Philippines</b></center>
			<center><b>SURIGAO DEL SUR STATE UNIVERSITY</b></center>
			<center><b>Tandag City , Surigao del Sur</b></center>
			<img src="{{ asset('/storage/img/sdssu-cecst-logo.png') }}" style="position:absolute; z-index: 2; top :0%; left :75%">
		</div>
			<br>
			<center><b>Report of Grades</b></center>
			 <center><b>SY {{ $current_semester->school_year . ' - ' . ($current_semester->school_year+1) }} / {{ digitToWord($current_semester->id) }} SEMESTER</b></center>
			<br>
			<br>

		<div class="sample">
			<span><b>{{ hyphenate($student->id_number) }}</b></span>
			<p><b>Student No.</b></p>
			<div style="text-align:center;">
				<span><b>{{ $student->fullname }}</b></span>
				<p><b>Full Name</b></p>
			</div>

			<div style="text-align: right;">
				<span><b>{{ ucwords($student->gender) }}</b></span>
				<p><b>Gender</b></p>
			</div>
		</div>

			<div style="line-height: 0px;">
				<b>Course Code : </b>BS{{$student->course->course_code }}
			</div>
			<div style="float:right; line-height: 0px;">
				  <b>Semestral GPA: {{  number_format($semestral, 1, '.', ',') }}</b>
			</div>

			<div style="line-height: 0px; margin-right : 150px;">
				<center><b>Department Code : </b>CECST</center>
			</div>
			<div style="line-height: 0px; margin-left : 250px;">
				<center><b>Year Level : </b>{{ $student->year }}</center>
			</div>
            <br>
            @if (str_contains(request()->path(),'report'))
            {{-- REPORT TABLE --}}
                <table style="width :100%;">
                    <thead>
                        <tr>
                            <th>Subject Name</th>
                            <th>Subject Description</th>
                            <th>Section</th>
                            <th>Time</th>
                            <th>Days</th>
                            <th>Room</th>
                            <th>Grade</th>
                            <th style="text-align:right;">GCompl Units</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($s_grades as $grade)
                        <tr>
                            <td>{{$grade->subject->sub}}</td>
                            <td>{{$grade->subject->sub_description}}</td>
                            <td>{{
                                @$grade->subject->schedule_sub->block_schedule['level'] .
                                @$grade->subject->schedule_sub->block_schedule['course'] .
                                @$grade->subject->schedule_sub->block_schedule['block_name']
                                }}</td>
          <td style="width:30%;" >
                  @foreach ($student->schedules as $s)
                    @if ($grade->subject_id == $s->subject_id)
                      {{$s->start_time}} -
                      {{$s->end_time}}
                    <br>
                    @endif
                  @endforeach
          </td>

          <td >
                  @foreach ($student->schedules as $s)
                    @if ($grade->subject_id == $s->subject_id)
                      {{$s->days}}
                    <br>
                    @endif
                  @endforeach
          </td>

          <td >
                  @foreach ($student->schedules as $s)
                    @if ($grade->subject_id == $s->subject_id)
                      {{$s->room}}
                    <br>
                    @endif
                  @endforeach
          </td>

          <th>{{($grade->remarks) ? $grade->remarks : 'NG'}}</th>
          <td>{{$grade->subject->units}}.0</td>
          @php
              $total_units += $grade->subject->units;
          @endphp

                        </tr>
                        @endforeach
                    </tbody>
                        <tr><td  style="text-align:right;" colspan="8"><b>Total credited units : {{$total_units}}</b></td></tr>
                </table>

                @else
                    {{-- NORMAL TABLE --}}
                    <table style="width:100%;">
                        <thead>
                            <tr>
                                <th>Subject Name</th>
                                <th>Subject Description</th>
                                <th>Grade</th>
                                <th style="text-align:right;">GCompl Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($s_grades as $grade)
                                <tr>
                                    <td>{{$grade->subject->sub}}</td>
                                    <td>{{$grade->subject->sub_description}}</td>
                                    <td><b>{{($grade->remarks != null) ? $grade->remarks : 'NG'}}</b></td>
                                    <td style="text-align:right;">{{number_format($grade->subject->units, 1, '.', ',')}}</td>
                                    @php $total_units += $grade->subject->units; @endphp
                                </tr>
                            @endforeach
                        </tbody>
                        <tr><td  style="text-align:right;" colspan="8"><b>Total credited units : {{$total_units}}</b></td></tr>
                    </table>
            @endif

			<br>


	<br>
	<br>
        @isset ($user_info)
		    <span><b>Certified By : <span style="text-decoration: underline;">{{strtoupper($user_info->name)}}</span></b></span>
        @endif
		 <span style="float:right;"><b><i>Printed : {{ date('m/d/Y  h:i:sA',strtotime('now')) }}</i></b></span>


	</body>
</html>

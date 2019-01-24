<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule</title>
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
            <center><b>SY {{ date('Y') . ' - ' . date('Y',strtotime("+1 year"))  }} / {{strtoupper(semesterWord($current_semester->id))}}</b></center>
            <br>
            <br>
                    <div class="row">

                            <div>
                             <span>Student No : {{ hyphenate($user_info->id_number) }} </span>
                            </div>
                             <div>
                                 <span>Student Name : {{ ucwords($user_info->fullname) }}</span>
                            </div>
                             <div>
                                 <span>Address :  {{ $user_info->address }}</span>
                            </div>
                              <div >
                                 <span>Year Level : {{ digitToYearLevel($user_info->year) }}    </span>
                            </div>
                            <div">
                                <span>Course : {{  $user_info->course->course_name }}
                             </span>
                            </div>
                            <div >
                                <span>Department : COLLEGE OF ENGINEERING, COMPUTERING STUDIES AND TECHNOLOGY
                             </span>
                            </div>
                             <div >
                                <span>Date Process : {{$date_process->format('d/m/Y g:i A')}} <span></span>
                             </span>
                            </div>
                        </div>
                        <br>
                        <br>
            <table border="1" style="border-collapse: collapse; padding : 3px;">
                            <thead >
                           <tr>
                                <td  width="15%">SUB. NAME</td>
                                <td  width="25%">SUBJECT DESCRIPTION</td>
                                <td >SECTION</td>
                                <td >UNITS</td>
                                <td >ROOM</td>
                                <td >DAYS</td>
                                <td width="20%"><center>TIME</center></td>
                                <td  width="20%">PAY UNITS</td>
                           </tr>
                            </thead>
                            <tbody>
                                @foreach ($student as $student_sched)
                                    @foreach ($student_sched->schedules as $schedule)
                                       <tr>
                                        <td ><center>{{ $schedule->subject->sub }}</center></td>
                                        <td ><center>{{ $schedule->subject->sub_description }}</center></td>
                                        <td ><center>{{ $schedule->block_schedule->level . $schedule->block_schedule->course . $schedule->block_schedule->block_name }}</center></td>
                                        <td ><center>{{ number_format($schedule->subject->units, 1, '.', ',')}}</center></td>
                                        <td ><center>{{ $schedule->room }}</center></td>
                                        <td ><center>{{ $schedule->days }}</center></td>
                                        <td width="20%" ><center>{{ $schedule->start_time . ' - ' . $schedule->end_time  }}</center></td>
                                        @php
                                            @$units += $schedule->subject->units;
                                        @endphp
                                        <td ><center>{{ number_format($schedule->subject->units, 1, '.', ',')}}</center></td>
                                       </tr>
                                    @endforeach
                                @endforeach
                                @if (isset($units))
                                    <td colspan="8" style="text-align: right;">Total units : {{ $units }}</td>
                                @endif
                            </tbody>
                        </table>
</body>
</html>
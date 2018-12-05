<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
        @page { margin: 100px 25px; }
        header { position: fixed; top: -60px; left: 0px; right: 0px; height: 50px; }
        p { page-break-after: always; }
        p:last-child { page-break-after: never; }
        </style>
        <title></title>
        <style>
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
        <header>
            <img src="{{ asset('/storage/img/sdssu.png') }}" style="position:absolute; left :18.7% top :0%">
            <center><b>Republic of the Philippines</b></center>
            <center><b>SURIGAO DEL SUR STATE UNIVERSITY</b></center>
            <center><b>Tandag City , Surigao del Sur</b></center>
            <img src="{{ asset('/storage/img/sdssu-cecst-logo.png') }}" style="position:absolute; z-index: 2; top :0%; left :75%">
        </header>
        <main>
            <br>
            {{--  <span><b>{{ hyphenate($student->id_number) }}</b></span>
            <b>Student No.</b>
            <span><b>{{ $student->fullname }}</b></span>
            <b>Full Name</b>
            <span><b>{{ ucwords($student->gender) }}</b></span>
            <b>Gender</b>
            <b>Course Code : </b>BS{{$student->course->course_code }}
            <b>Semestral GPA: </b>
            <center><b>Department Code : </b>CECST</center>
            <center><b>Year Level : </b>{{ $student->year }}</center> --}}
            @foreach ($subjects as $k => $subject)
            @php
             $total_units = 0; $count = 0;
             $semestral_gpa = 0;
             $gpa = 0;
            @endphp
            <span>{{$subject[0]['semester']}} semester</span>
            <div style="float:right;">
                {{-- <span>Semestral GPA: </span> --}}
            </div>
            <table style="width:100%;">
                <thead>
                    <tr>
                        <th><center>Subject Name</center></th>
                        <th><center>Subject Description</center></th>
                        <th><center>Subject Grade</center></th>
                        <th><center>Units</center></th>
                    </tr>
                </thead>
                @foreach ($subject as $sub)
                <tr>
                    <td><center>{{$sub['sub']}}</center></td>
                    <td><center>{{$sub['sub_description']}}</center></td>

                    <td><center>{{number_format($sub->grade['remarks'], 1, '.', ',')}}</center></td>
                    @php
                        $total_units += $sub['units'];
                        $gpa += $sub->grade['remarks'];
                        $count++;
                    @endphp
                    <td><center>{{number_format($sub['units'], 1, '.', ',')}}</center></td>
                </tr>
                @endforeach
            </table>
            <div style="float:left;">
                 @if (!empty($gpa) && $count != 0)
                    @php $semestral_gpa = $gpa /  $count; @endphp
                    @else
                    @php $semestral_gpa = 0; @endphp
                @endif
                <span><b>Semestral GPA : {{ number_format($semestral_gpa, 1, '.', ',') }}</b></span>
            </div>

             <div style="float: right; margin-right: 30px;">
                <span><b>Total Credited Units : {{ $total_units }}</b> </span>
            </div>
            <div style="clear:both;"></div>
            <br>
            @if ($loop->index == 3)
            <p></p>
            @endif
            @endforeach
        </main>
    </body>
</html>
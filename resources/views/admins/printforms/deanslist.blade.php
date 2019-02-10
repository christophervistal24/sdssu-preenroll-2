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
			<center><b>LIST OF ALL DEANS LISTER</b></center>
			<center><b>SY {{ $current_semester[0]->school_year . ' - ' . ($current_semester[0]->school_year+1) }} / {{ digitToWord($current_semester[0]->id) }} SEMESTER</b></center>
			<br>
			<br>
          <table  style="width :100%; border-collapse: collapse;" border="1">
                            <thead>
                              <tr>
                                <th>ID No.</th>
                                <th>Fullname</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Year</th>
                                <th>Course</th>
                                <th>Mobile No.</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $list_info)
                                    <tr>
                                        <td  style="width :20%;"> {{hyphenate($list_info->student->id_number)}}</td>
                                        <td  style="width :20%;">{{$list_info->student->fullname}}</td>
                                        <td style="width :20%;">{{$list_info->student->address}}</td>
                                        <td>{{ucfirst($list_info->student->gender)}}</td>
                                        <td style="width :20%;">{{digitToYearLevel($list_info->student->year)}}</td>
                                        <td>BS{{$list_info->student->course->course_code}}</td>
                                        <td>{{$list_info->student->mobile_number}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
<br>
<br>
    @isset ($user_info)
        <span><b>Certified By : <span style="text-decoration: underline;">{{strtoupper($user_info->name)}}</span></b></span>
        @endif
     <span style="float:right;"><b><i>Printed : {{ date('m/d/Y  h:i:s A',strtotime('now')) }}</i></b></span>

	</body>
</html>

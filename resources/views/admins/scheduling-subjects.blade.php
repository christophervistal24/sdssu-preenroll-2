@php
$start_time = [
'7:30 AM',
'8:00 AM',
'8:30 AM',
'9:00 AM',
'9:30 AM',
'10:00 AM',
'10:30 AM',
'11:00 AM',
'11:30 AM',
'12:00 PM',
'12:30 PM',
'1:00 PM',
'1:30 PM',
'2:00 PM',
'2:30 PM',
'3:00 PM',
'3:30 PM',
'4:00 PM',
'4:30 PM',
'5:00 PM',
'5:30 PM',
'6:00 PM',
];
@endphp
@include('errors.error')
@include('success.success-message')
<form autocomplete="off" action="{{ url('/admin/scheduling') }}" method="POST">
	@csrf
	<div class="form">
		{{-- TIME --}}
		<label>Time : </label>
		<div class="form-group row">
			<select name="start_time" onchange="getTime(this)" id="startTime" data-live-search="true"  class="selectpicker form-control col-md-6" >
				<option selected disabled>Start time</option>
				@foreach ($start_time as $time)
				<option  value="{{ $time }}" {{ (old('start_time') == $time ? "selected":"") }}>{{ $time }}</option>
				@endforeach
			</select>
			<select name="end_time" id="endTime" data-live-search="true"  class="selectpicker form-control col-md-6">
				<option selected disabled>End time</option>
				@foreach ($start_time as $time)
				<option  value="{{ $time }}" {{ (old('end_time') == $time ? "selected":"") }}>{{ $time }}</option>
				@endforeach
			</select>
		</div>
		{{-- DAYS --}}
		<label>Days : </label>
		<div class="form-group row">
			<select name="days" data-live-search="true"  class="selectpicker form-control">
				<option selected disabled>Select Days</option>
				<option value="MWF" {{ (old('days') == 'MWF' ? "selected":"") }}>MWF</option>
				<option value="MW" {{ (old('days') == 'MW' ? "selected":"") }}>MW</option>
				<option value="TTH" {{ (old('days') == 'TTH' ? "selected":"") }}>TTH</option>
				<option value="S" {{ (old('days') == 'S' ? "selected":"") }}>S</option>
			</select>
		</div>
		{{-- ROOM --}}
		<label>Rooms : </label>
		<div class="form-group row">
			<select name="room" data-live-search="true" class="selectpicker form-control col-md-12">
				<option disabled selected>Select Room</option>
				@foreach ($rooms as $room)
				<option value="{{ $room->room_number }}"
					{{ (old('room') == $room->room_number ? "selected":"") }}
				>Room {{ $room->room_number }}</option>
				@endforeach
			</select>
		</div>
		{{-- <label>Instructors : </label> --}}
		{{-- <div class="form-group row " >
			<select name="instructor" class="form-control col-md-12">
				<option disabled selected>Select Instructor</option>
				@foreach ($instructors as $instructor)
				<option
					value="{{ ucwords($instructor->name) }}"
					{{ (old('instructor') == ucwords($instructor->name) ? "selected":"") }}
				>{{ ucwords($instructor->name) }}</option>
				@endforeach
			</select>
		</div> --}}
		<hr>
		{{-- FIRST YEAR --}}
		<div class="form-group row">
			<span class="col-md-2 offset-2">CS Subjects</span>
			<span class="col-md-2 offset-5">CE Subjects</span>
		</div>
		<br>
		<label>First year subject : </label>
		<div class="form-group row">
			<select name="subject[CS]"  id="subject_1_1" class="form-control col-md-6 selectpicker" data-live-search="true">
				<option disabled selected>First year subjects</option>
				@foreach ($first_year_cs as $subjects)
				<option
					value="{{ $subjects->sub_description }}"
					{{ (old('subject') == $subjects->sub_description ? "selected":"") }}
					>
					{{  $subjects->sub . ' - ' . ucwords($subjects->sub_description) }}
				</option>
				@endforeach
			</select>
			<select name="subject[CS]"  id="subject_1_1" class="form-control col-md-6 selectpicker" data-live-search="true">
				<option disabled selected>First year subjects</option>
				@foreach ($first_year_ce as $subjects)
				<option
					value="{{ $subjects->sub_description }}"
					{{ (old('subject') == $subjects->sub_description ? "selected":"") }}
					>
					{{  $subjects->sub . ' - ' . ucwords($subjects->sub_description)  }}
				</option>
				@endforeach
			</select>
		</div>
		{{-- SECOND YEAR --}}
		<label>Second year subject : </label>
		<div class="form-group row">
			<select name="subject[CS]" data-live-search="true" id="subject_2_1" class="selectpicker form-control col-md-6">
				<option disabled selected>Second year subjects</option>
				@foreach ($second_year_cs as $subjects)
				<option
					value="{{ $subjects->sub_description }}"
					{{ (old('subject') == $subjects->sub_description ? "selected":"") }}
					>
					{{  $subjects->sub . ' - ' . ucwords($subjects->sub_description) }}
				</option>
				@endforeach
			</select>
			<select name="subject[CS]"  id="subject_1_1" class="form-control col-md-6 selectpicker" data-live-search="true">
				<option disabled selected>First year subjects</option>
				@foreach ($second_year_ce as $subjects)
				<option
					value="{{ $subjects->sub_description }}"
					{{ (old('subject') == $subjects->sub_description ? "selected":"") }}
					>
					{{  $subjects->sub . ' - ' . ucwords($subjects->sub_description) }}
				</option>
				@endforeach
			</select>
		</div>
		{{-- THIRD YEAR --}}
		<label>Third year subject : </label>
		<div class="form-group row">
			<select name="subject[CS]" data-live-search="true"  id="subject_3_1" class="selectpicker form-control col-md-6">
				<option disabled selected>Third year subjects</option>
				@foreach ($third_year_cs as $subjects)
				<option
					value="{{ $subjects->sub_description }}"
					{{ (old('subject') == $subjects->sub_description ? "selected":"") }}
					>
					{{  $subjects->sub . ' - ' . ucwords($subjects->sub_description) }}
				</option>
				@endforeach
			</select>
			<select name="subject[CS]"  id="subject_1_1" class="form-control col-md-6 selectpicker" data-live-search="true">
				<option disabled selected>First year subjects</option>
				@foreach ($third_year_ce as $subjects)
				<option
					value="{{ $subjects->sub_description }}"
					{{ (old('subject') == $subjects->sub_description ? "selected":"") }}
					>
					{{  $subjects->sub . ' - ' . ucwords($subjects->sub_description) }}
				</option>
				@endforeach
			</select>
		</div>
		<label>Fourth year subject :</label>
		<div class="form-group row">
			<select name="subject[CS]" id="subject_3"  data-live-search="true"  class="selectpicker form-control col-md-6">
				<option disabled selected>Fourth year subjects</option>
				@foreach ($fourth_year_cs as $subjects)
				<option
					value="{{ $subjects->sub_description }}"
					{{ (old('subject') == $subjects->sub_description ? "selected":"") }}
					>
					{{  $subjects->sub . ' - ' . ucwords($subjects->sub_description) }}
				</option>
				@endforeach
			</select>
			<select name="subject[CS]"  id="subject_1_1" class="form-control col-md-6 selectpicker" data-live-search="true">
				<option disabled selected>First year subjects</option>
				@foreach ($fourth_year_ce as $subjects)
				<option
					value="{{ $subjects->sub_description }}"
					{{ (old('subject') == $subjects->sub_description ? "selected":"") }}
					>
					{{  $subjects->sub . ' - ' . ucwords($subjects->sub_description) }}
				</option>
				@endforeach
			</select>
		</div>
			<select name="subject[CS]"  id="subject_1_1" class="form-control float-right  col-md-6 selectpicker" data-live-search="true">
				<option disabled selected>Fifth year subjects</option>
				@foreach ($fifth_year_ce as $subjects)
				<option
					value="{{ $subjects->sub_description }}"
					{{ (old('subject') == $subjects->sub_description ? "selected":"") }}
					>
					{{  $subjects->sub . ' - ' . ucwords($subjects->sub_description)  }}
				</option>
				@endforeach
			</select>
		<div class="clearfix"></div>
		<hr>
		<label>Blocks : </label>
		<select name="block" class="form-control col-md-6 selectpicker" data-live-search="true">
				<option disabled selected>Blocks</option>
				@foreach ($blocks as $block)
				<option
					value="{{ $block->level . $block->course . $block->block_name }}"
					{{ (old('block') == $block->level . $block->course . $block->block_name ? "selected":"") }}
					>
					{{  $block->level . $block->course . $block->block_name }}
				</option>
				@endforeach
			</select>
		<hr>
		<div class="form-group col-md-12">
			<div class="float-right">
				<button class="btn btn-primary" type="submit">Add Schedule</button>
			</div>
			<br>
		</div>
	</div>
</form>

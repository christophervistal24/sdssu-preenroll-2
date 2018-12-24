{{-- MODAL START --}}
    <!-- Modal -->
    <div class="modal fade" id="editSchedule" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content rounded-0">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Schedule</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @php
            $start_time = [
            '7:30 AM','8:00 AM','8:30 AM','9:00 AM','9:30 AM','10:00 AM',
            '10:30 AM','11:00 AM','11:30 AM','12:00 PM','12:30 PM','1:00 PM',
            '1:30 PM','2:00 PM','2:30 PM','3:00 PM','3:30 PM','4:00 PM',
            '4:30 PM','5:00 PM','5:30 PM','6:00 PM'];
            @endphp
            @include('errors.error')
            <form id="scheduleForm" autocomplete="off"  onsubmit="event.preventDefault();" method="POST">
                @csrf
                <div class="form">
                    <input type="hidden" id="scheduleId" name="schedule_id">
                    <label>Time : </label>
                    <div class="row form-group">
                        <select name="start_time" id="start_time"  data-live-search="true" class="selectpicker form-control col-md-6">
                            <option selected disabled>Start time</option>
                            @foreach ($start_time as $time)
                            <option  value="{{ $time }}">{{ $time }}</option>
                            @endforeach
                        </select>
                        <select name="end_time" id="end_time" data-live-search="true" class="selectpicker form-control col-md-6">
                            <option selected disabled>End time</option>
                            @foreach ($start_time as $time)
                            <option  value="{{ $time }}">{{ $time }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- DAYS --}}
                    <label>Days : </label>
                    <div class="form-group row">
                        <select name="days" id="days" data-live-search="true" class="selectpicker form-control col-md-12">
                            <option selected disabled>Select Days</option>
                            <option value="MWF" {{ (old('days') == 'MWF' ? "selected":"") }}>MWF</option>
                            <option value="TTH" {{ (old('days') == 'TTH' ? "selected":"") }}>TTH</option>
                            <option value="S" {{ (old('days') == 'S' ? "selected":"") }}>S</option>
                        </select>
                    </div>

                </div>
                {{-- ROOM --}}
                <label>Rooms & Blocks : </label>
                <div class="form-group row">
                    <select name="room" id="room"  data-live-search="true" class="selectpicker form-control col-md-6">
                        <option disabled selected>Select Room</option>
                        @foreach ($rooms as $room)
                        <option value="{{ $room->room_number }}"
                            {{ (old('room') == $room->room_number ? "selected":"") }}
                        >Room {{ $room->room_number }}</option>
                        @endforeach
                    </select>
                    <select name="block" id="block"  data-live-search="true" class="selectpicker form-control col-md-6">
                        <option disabled selected>Select Block</option>
                        @foreach ($blocks as $block)
                        <option value="{{ $block->id }}"
                        >{{ $block->level . $block->course . $block->block_name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- FIRST YEAR --}}
                <label>First yr. Subject : </label>
                <div class="form-group row">
                    <select name="subject_id"  id="subject_1" data-live-search="true" class="selectpicker form-control col-md-12">
                        <option disabled selected>First year</option>
                        @foreach ($subjects[1] as $subject)
                            <option
                                value="{{ $subject->id }}"
                                >
                                {{  $subject->sub . ' - ' . ucwords($subject->sub_description) }}
                            </option>
                        @endforeach

                    </select>
                </div>
                {{-- SECOND YEAR --}}
                <label>Second yr. Subject : &nbsp;</label>
                <div class="form-group row">
                    <select name="subject_id" id="subject_2" data-live-search="true" class="selectpicker form-control col-md-12">
                        <option disabled selected>Second year</option>
                        @foreach ($subjects[2] as $subject)
                        <option value="{{ $subject->id }}">
                            {{  $subject->sub . ' - ' . ucwords($subject->sub_description) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                {{-- THIRD YEAR --}}
                <label>Third year Subject :</label>
                <div class="form-group row">
                    <select name="subject_id" data-live-search="true" id="subject_3" class="selectpicker form-control col-md-12">
                        <option disabled selected>Third year</option>
                        @foreach ($subjects[3] as $subject)
                        <option value="{{ $subject->id }}">
                            {{  $subject->sub . ' - ' . ucwords($subject->sub_description) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                {{-- FOURTH YEAR --}}
                <label>Fourth year subject : </label>
                <div class="form-group row">
                    <select name="subject_id" id="subject_4" data-live-search="true" class="selectpicker form-control col-md-12">
                        <option disabled selected>Fourth year</option>
                        @foreach ($subjects[4] as $subject)
                        <option value="{{ $subject->id }}">
                            {{  $subject->sub . ' - ' . ucwords($subject->sub_description) }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- FIFTH YEAR --}}
                <label>Fifth year subject : </label>
                <div class="form-group row">
                    <select name="subject_id" id="subject_4" data-live-search="true" class="selectpicker form-control col-md-12">
                        <option disabled selected>Fifth year</option>
                        @foreach ($subjects[5] as $subject)
                        <option value="{{ $subject->id }}">
                            {{  $subject->sub . ' - ' . ucwords($subject->sub_description) }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <div class="float-right">
                        <button class="btn btn-primary" type="submit">Update Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>
{{-- MODAL END --}}

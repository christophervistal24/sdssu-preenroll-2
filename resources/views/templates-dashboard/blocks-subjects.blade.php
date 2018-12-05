<div class="row">
    <div class="list-group col-md-6 p-4 card rounded-0" style=" height : auto;">
        <span class="text-uppercase page-subtitle text-center">List of subjects</span>
        <hr>
        <div id="sortTrue" style="cursor:pointer; height:auto;">
            <br>
            <script>
                function sample(subject)
                {
                    if(subject.pre_requisite_code != null)
                    {
                        swal(
                            subject.pre_requisite_code,
                            ''
                        );
                    } else {
                        swal('No Pre requisite','');
                    }
                }
            </script>
            @foreach ($schedules as $schedule)
            <input onclick="return sample({{
                json_encode(['pre_requisite_code' => $schedule->pre_requisite_code ])
            }});
            " data-id="{{ $schedule->id }}"  style="cursor:pointer; background:white;"  name="subjects[{{ $schedule->subject_id }}][{{ $schedule->id }}]" data-units="{{ $schedule->units }}" class="p-3 mb-3 form-control border-0 rounded-0 font-weight-bold js-remove" readonly value="{{$schedule->start_time . ' - ' . $schedule->end_time . ' - ' . $schedule->days . ' - ' . $schedule->room . ' - ' . $schedule->sub_description . ' - ' . $schedule->units . ' Units'
            }}">

            {{-- <div class="text-warning">{{ $schedule->pre_requisite_code }}</div> --}}
           @endforeach
        </div>
    </div>
    <!-- sort: false -->
    <form method="POST" class="list-group col-md-6 p-4 card rounded-0" style="height : auto;">
        @csrf

        <span class="text-uppercase page-subtitle text-center"> Drag subjects here<button type="submit" id="preEnrollBtnSave"  class="btn btn-primary float-right btn-sm rounded-0 border-0">Save</button>
        </span>
        <span id="noOfUnits">Total units : 0</span>
        <hr>
        <div id="sortFalse" class="list-group col-md-12">
            <input type="hidden" id="studentIdNumber" name="user_id" value="{{ $user_info->id_number }}">
        </div>
    </form>
</div>
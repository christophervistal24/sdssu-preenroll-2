@php $total_units = 0; $gpa = 0; $semestra_gpa = 0; @endphp
@foreach ($subject as $key => $s1)
    @foreach ($s_grades as $grade)
       @if (!is_null($grade->grades))
            @foreach ($grade->grades as $subject_grade)
                @if ($subject_grade->subject_id == $s1['id'])
                @php
                    $count++;
                    $gpa += $subject_grade->remarks;
                @endphp
                @endif
        @endforeach
       @endif
    @endforeach
@endforeach
@php $semestral_gpa = $gpa / $count; @endphp

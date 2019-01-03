$(document).ready(function () {
  let studentCourse  = null;
  let fromYearValue  =  null;
  let toYearValue    =  null;
  let studentIdNumber = null;
  let tableStudentGrades;


  $(document).on('click','#withRange' , function () {
      //get the student course
      //
      studentCourse = $(this).attr('data-course');
      studentIdNumber = $(this).attr('data-id_number');
      $('#studentGrades').val($('.grades').html().replace(/<a.*?<\/a>/gi,''));
      //display the modal
      // $('#printRangeInfo').modal('toggle');
      $('#printWithRange').trigger('click');
      checkCourse(studentCourse);
  });

  // $('#printWithRange').click(function(e) {
  //   e.preventDefault();
  //   // tableStudentGrades
  //   location.replace(`/admin/student/print/${fromYearValue}/${toYearValue}`);
  // });


  $('#fromYear').change(function () {
    //get the from year value
    fromYearValue = parseInt($(this).val(),10);
  });

  $('#toYear').change(function () {
    //get the to year value
    toYearValue = parseInt($(this).val(),10);
  });



  //checking the student course
  function checkCourse(student_course)
  {
      student_course = student_course.toLowerCase();
      if (student_course !== 'cs') {
          //add fifth year for the select box
      }
  }

  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
  });
});

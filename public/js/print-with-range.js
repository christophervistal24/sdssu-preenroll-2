$(document).ready(function () {
  let studentCourse  = null;
  let fromYearValue  =  null;
  let toYearValue    =  null;
  let studentIdNumber = null;

  $(document).on('click','#withRange' , function () {
      //get the student course
      studentCourse = $(this).attr('data-course');
      studentIdNumber = $(this).attr('data-id_number');
      //display the modal
      $('#printRangeInfo').modal('toggle');
      checkCourse(studentCourse);
  });

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

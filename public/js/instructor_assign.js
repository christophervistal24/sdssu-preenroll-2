$(document).ready(function () {

   //students pre enroll
      let dragged_subject = $('#dragged-subject');
         // sort: true
        Sortable.create(sortTrue, {
          animation:200,
          group: {name:'sorting', pull:'clone' ,put:'dragged_schedules'},
          sort: true,
        });

        // sort: false
        Sortable.create(sortFalse, {
          animation:200,
          group: "sorting",
          name:'dragged_schedules',
          sort: false,
          put:false,
          animation: 150,  // ms, animation speed moving items when sorting, `0` — without animation
          easing: "cubic-bezier(1, 0, 0, 1)", // Easing for animation. Defaults to null. See https://easings.net/ for examples.
          ghostClass: 'sortable-ghost',
          onAdd: function (/**Event*/evt) {
            let item = evt.item;
            let scheduleId = $('#scheduleId').val();
            let instructorIdNumber = $(item).attr('data-id-number');
            checkInstructorSchedule(scheduleId,instructorIdNumber);
         },
        onRemove: function (/**Event*/evt) {

        },
         // Called when creating a clone of element
        onClone: function (/**Event*/evt) {
           var origEl = evt.item;
            var cloneEl = evt.clone;
        },
  });




  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });


/**
 * Checking the instructor schedule in DB if not conflict
 */
  function checkInstructorSchedule(scheduleId , instructorIdNumber)
  {
  let result = true;
  $.ajax({ // create subject
                    /* the route pointing to the post function */
                    url: `/assistantdean/assign/check/${scheduleId}/${instructorIdNumber}`,
                    type: 'GET',
                    /* send the csrf-token and the input to the controller */
                    // data: {schedule_id:scheduleId,instructorIdNumber:instructorIdNumber},
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                      if (!data.first_schedule.is_valid) {
                        result = true;
                        const el = document.createElement('div')
                        el.innerHTML = `Please click <a href=/assistantdean/assign/checkresult/${scheduleId}/${instructorIdNumber}/view>this link</a> to view all schedules that conflicts.`;
                          swal({
                            title: 'Conflict of schedules',
                            content: el,
                            icon: "error",
                          });
                      } 

                    },
            });

  return result;
  }


});

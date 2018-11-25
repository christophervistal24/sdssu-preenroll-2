$(document).ready(function () {
  let timeAndDay = [];
  let studentIdNumber = $('#studentIdNumber').val();



   //students pre enroll
      let dragged_subject = $('#dragged-subject');
         // sort: true
        Sortable.create(sortTrue, {
          animation:200,
          group: "sorting",
          sort: true,
        });

        // sort: false
        Sortable.create(sortFalse, {
          animation:200,
          group: "sorting",
          sort: false,
          ghostClass: 'sortable-ghost',
          onAdd: function (/**Event*/evt) {
            let item = evt.item;
            let child = $(evt.to).children();
            let noOfUnitsEl = $('#noOfUnits');
            let units = 0;
            let sum = 0;
            let subjects = [];
            $.each(child , function (key , value) {
              //get all dragged subjects
                if(units = $(value).attr('data-units'))
                {
                    subjects.push($(value).attr('name').match(/\d+/)[0]);
                    sum += parseInt(units,10);
                    noOfUnitsEl.html('Total units : ' + sum);
                }
            });
            checkConflictSubject($(item).val());
            checkPrerequisite(subjects);
        },
        onRemove: function (/**Event*/evt) {
            let item = evt.item;
            let child = $(evt.to).children();
            let noOfUnitsEl = $('#noOfUnits');
            let units = 0;
            let sum = 0;
            $.each(child , function (key , value) {
              //get all dragged subjects
              // add ajax here
                if(units = $(value).attr('data-units'))
                {
                    sum += parseInt(units,10);
                    noOfUnitsEl.html('Total units : ' + sum);
                } else {
                    noOfUnitsEl.html('Total units : ' + sum);
                }

            });
            removeSubjectInArray(timeAndDay,$(item).val()); //remove the selected item in the array
        },
  });

  function ajaxRunSetup()
  {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  }

  function removeSubjectInArray(array, element) {
    element = element.match(/(((.*?)-(.*?)-){2})/)[0];
    const index = array.indexOf(element);
      if (index !== -1) {
          array.splice(index, 1);
      }
  }

  //check conflict subject that dragged
  function checkConflictSubject(dayTime)
  {
      let getDateAndTime = dayTime.match(/(((.*?)-(.*?)-){2})/)[0];
      let check = null;
      check = timeAndDay.includes(getDateAndTime); //check dragged
      if (check) {
        alert(dayTime + ' is conflict to your other subjects');
      } else {
        checkScheduleInDB(getDateAndTime,studentIdNumber);
        timeAndDay.push(getDateAndTime);
      }
      console.log(timeAndDay);

  }

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

 function checkScheduleInDB(subject,id_number)
 {
  $.ajax({ // create subject
                    /* the route pointing to the post function */
                    url: '/student/preenrol',
                    type: 'PUT',
                    /* send the csrf-token and the input to the controller */
                    data: {subject:subject,student_id_number:id_number},
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if (data.schedule_data  === undefined || data.schedule_data .length == 0) {
                        } else {
                          swal({
                            title: 'Fail to load',
                            text: 'This subject may cause conflict to your other subjects better to check your schedule',
                            icon: "error",
                          })
                          .then((willDelete) => {
                            if (willDelete) {
                                location.reload();
                            }
                          });
                        }
                    },
            });
 }

  //check subject pre-requisite
  function checkPrerequisite(value)
  {
      $.ajax({ // create subject
                    /* the route pointing to the post function */
                    url: '/student/checkpreq',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {subjects:value},
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                      if (data.success == false) {
                            swal({
                            title: 'Failed',
                            text: data.message,
                            icon: "error",
                          })
                          .then((willDelete) => {
                            if (willDelete) {
                                location.reload();
                              // swal("Poof! Your imaginary file has been deleted!", {
                              //   icon: "success",
                              // });
                            }
                          });
                      }
                    },
            });
  }


});

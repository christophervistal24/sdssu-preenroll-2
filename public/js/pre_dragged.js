$(document).ready(function () {
  let timeAndDay = [];
  let studentIdNumber = $('#studentIdNumber').val();
  let sum = 0;
  let noOfUnitsEl = $('#noOfUnits');
  let selectedSubject = null;

   //students pre enroll
      let dragged_subject = $('#dragged-subject');
         // sort: true
        Sortable.create(sortTrue, {
          animation:200,
          group: {name:'sorting', pull:'clone' ,put:'dragged_subjects'},
          sort: true,
        });

        // sort: false
        Sortable.create(sortFalse, {
          animation:200,
          group: "sorting",
          name:'dragged_subjects',
          sort: false,
          put:false,
          ghostClass: 'sortable-ghost',
          onAdd: function (/**Event*/evt) {
            let item = evt.item;
            let child = $(evt.to).children();
            let units = 0;
            sum = 0;
            let subjects = [];
            selectedSubject= item;
            $.each(child , function (key , value) {
              //get all dragged subjects
                if(units = $(value).attr('data-units'))
                {
                    subjects.push($(value).attr('name').match(/\d+/)[0]);
                    sum += parseInt(units,10);
                    noOfUnitsEl.html('Total units : ' + sum);
                }
            });
            // $(item).attr('id','dragged_s');
            if (checkConflictSubject(item)) {
                $(item).remove();
            }
            checkPrerequisite(subjects);
        },
        onRemove: function (/**Event*/evt) {
            let item = evt.item;
            let child = $(evt.to).children();
            let units = 0;
            sum = 0;
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
        filter: ".js-remove",
        onFilter: function (evt) {
          var item = evt.item,
            ctrl = evt.target;
          if (Sortable.utils.is(ctrl, ".js-remove")) {  // Click on remove button
                removeSubjectInArray(timeAndDay,$(item).val());
                sum = sum - $(item).attr('data-units');
                noOfUnitsEl.html('Total units : ' + sum);
                item.parentNode.removeChild(item); // remove sortable item
          }
        },
         // Called when creating a clone of element
        onClone: function (/**Event*/evt) {
            var origEl = evt.item;
            var cloneEl = evt.clone;
        }
  });

  function sample()
  {
    alert(1);
  }


  function removeSubjectInArray(array, element) {
    element = element.match(/(((.*?)-(.*?)-){2})/)[0];
    const index = array.indexOf(element);
      if (index !== -1) {
          array.splice(index, 1);
      }
  }

  //check conflict subject that dragged
  function checkConflictSubject(dayTime,item)
  {
      let getDateAndTime = $(dayTime).val().match(/(((.*?)-(.*?)-){2})/)[0];
      let check = null;
      check = timeAndDay.includes(getDateAndTime); //check dragged
      if (check) {
        sum = sum  - $(dayTime).attr('data-units');
        noOfUnitsEl.html('Total units : ' + sum);
        alert($(dayTime).val() + ' is conflict to your other subjects');
        return true;
      } else {
        checkScheduleInDB(getDateAndTime,studentIdNumber);
        timeAndDay.push(getDateAndTime);
        return false;
      }


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
                          $('#preEnrollBtnSave').attr('disabled','disabled');
                          removeSubjectInArray(timeAndDay,$(selectedSubject).val());
                          sum  = sum - $(selectedSubject).attr('data-units');
                          noOfUnitsEl.html('Total units : ' + sum);
                          swal({
                            title: 'Fail to load',
                            text: $(selectedSubject).val() + ' may cause conflict to your other subjects better to check your schedule ... ',
                            icon: "error",
                          });
                            $(selectedSubject).remove();
                            setTimeout(function(){
                                $('#preEnrollBtnSave').removeAttr('disabled');
                            }, 3000);
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

                          removeSubjectInArray(timeAndDay,$(selectedSubject).val());
                          sum  = sum - $(selectedSubject).attr('data-units');
                          noOfUnitsEl.html('Total units : ' + sum);
                          $(selectedSubject).remove();
                            swal({
                            title: 'Failed',
                            text: data.message  ,
                            icon: "error",
                          })
                          .then((willDelete) => {
                            if (willDelete) {
                                // location.reload();
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

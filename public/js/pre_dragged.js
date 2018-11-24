$(document).ready(function () {
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
            checkPrerequisite(subjects);
        },
        onRemove: function (/**Event*/evt) {
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

$(document).ready(function () {

	$('.selectpicker').selectpicker({ maxOptions:2});
	let subject_info;
	$('#addSubject').click(  function() {
		$('#action').val('add');
		$('.selectpicker').selectpicker('val','');
		$('#subjectModal').modal('toggle');
		$('#subjectForm')[0].reset();
		$('#subjectTitle').html('Add new subject');
	});

	$(document).on('click' ,'#displayEditModal ' , function () {
		$('#action').val('edit');
		$('.selectpicker').selectpicker('val','');
		$('#subjectModal').modal('toggle');
		 subject_info = JSON.parse($(this).attr('params'));

		$('#subjectTitle').html('Edit ' + subject_info.subject_sub);
		$('#subjectCode').val(subject_info.subject_sub);
		$('#subjectDesc').val(subject_info.subject_description);
		$('#subjectUnits').val(subject_info.subject_units);
		$('#subjectYear').val(subject_info.subject_year);
		$('#subjectSemester').val(subject_info.subject_semester);
		$('#course').selectpicker('val',subject_info.subject_course);
		$('#course').selectpicker('refresh');

		if (subject_info.subject_prereq.includes(',')) {
			let splitted_string = subject_info.subject_prereq.split(',');
			$('.selectpicker').selectpicker('val',splitted_string);
			$('.selectpicker').selectpicker('refresh');
		} else {
		 	$('.selectpicker').selectpicker('val',subject_info.subject_prereq);
			$('.selectpicker').selectpicker('refresh');
		}

	});

	$('#subjectForm').submit(function (event) {
		event.preventDefault();
		let formAction = $('#action').val();
		if (formAction.toLowerCase() == 'add') {
			 $.ajax({ // create subject
                    /* the route pointing to the post function */
                    url: '/admin/subjectcreate',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: $(this).serialize(),
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if (data.success == true) {
                        	swal("Subject created",'Successfully create new subject',"success")
							.then((value) => {
							  location.reload();
							});
                        }
                    },
                    error: function (data) {
				        swal({
						  title: "Please check all you input",
						  text: "We detect that you miss some fields don't leave it blank",
						  icon: "error",
						  buttons: true,
						  dangerMode: true,
						})
    				}
      		});
			} else {
				$.ajax({ // create subject
                    /* the route pointing to the post function */
                    url: '/admin/subjectupdate/'+subject_info.subject_id,
                    type: 'PUT',
                    /* send the csrf-token and the input to the controller */
                    data: $(this).serialize(),
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if (data.success == true) {
                        	swal("Subject updated",'Successfully updated a subject',"success")
							.then((value) => {
							  location.reload();
							});
                        }
                    },
      			});
			}

	});
});

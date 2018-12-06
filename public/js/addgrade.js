$(document).ready(function() {
	let information;
	let inputGrade = $('#studentGrade');
	let modalTitle = $('#modalTitle');
	let studentGrade = $('#studentGrade');
	let action = $('#action');

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	$(document).on('click' , '#btnAddGrade ', function () {
		$('#remarksForm')[0].reset();
		action.val('add');
		information = $.parseJSON($(this).attr('params'));
		modalTitle.html($(this).html() + ' for ' + information.fullname);
		$('#modalAddGrade').modal('toggle');
	});

	$(document).on('click' , '#btnEditGrade ', function () {
		$('#remarksForm')[0].reset();
		action.val('edit');
		information = $.parseJSON($(this).attr('params'));
		modalTitle.html($(this).html() + ' for ' + information.fullname);
		studentGrade.val(information.remarks);
		$('#modalAddGrade').modal('toggle');
	});


	$('#remarksForm').submit(function (event) {
		event.preventDefault();
		if (action.val() == 'add') {
			$.ajax({ // create subject
                    /* the route pointing to the post function */
                    url: '/instructor/students/' + information.subject_id,
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data : {
                    	student_id_number:information.student_id_number,
                    	subject_id:information.subject_id,
                    	student_grade:inputGrade.val(),
                        grade_id:information.grade_id,
                        schedule_id:information.schedule_id
                    },
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if (data.success == true) {
                        	swal("Successfully add grade!", {
						      icon: "success",
						    }).then((value) => {
							  location.reload();
							});
                        }
                    }
            });
		} else {
				$.ajax({ // create subject
                    /* the route pointing to the post function */
                    url: '/instructor/students/' + information.subject_id,
                    type: 'PUT',
                    /* send the csrf-token and the input to the controller */
                    data : {
                    	student_id_number:information.student_id_number,
                    	subject_id:information.subject_id,
                    	student_grade:inputGrade.val(),
                        grade_id:information.grade_id
                    },
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if (data.success == true) {
                        	swal("Grade successfully update!", {
						      icon: "success",
						    }).then((value) => {
							  location.reload();
							});
                        }
                    }

            });
		}
	});

});

$(document).ready(function () {
	let instructorId            = $('#instructorId');
	let instructorFullname      = $('#instructorFullname');
	let instructorIdNumber      = $('#instructorIdNumber');
	let instructorEducationQual = $('#instructorEducationQual');
	let instructorPosition      = $('#instructorPosition');
	let instructorStatus        = $('#instructorStatus');
	let instructorIsActive      = $('#instructorIsActive');
	let instructorNumber        = $('#mobileNumber');
	let instructorMajor 		= $('#instructorMajor');
	let info;

	$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
	});

	$(document).on('click','#btnEditInstructorInfo ',function () {
		$('#editInstructor').modal('toggle');
		info = $.parseJSON($(this).attr('params'));
		setInstructorFieldsValue();
	});

	function setInstructorFieldsValue() {
		instructorFullname.val(info.name);
		instructorIdNumber.val(info.id_number);
		instructorEducationQual.val(info.edu);
		instructorPosition.val(info.position);
		instructorStatus.val(info.status);
		instructorIsActive.val(info.active);
		instructorNumber.val(info.mobile);
		instructorMajor.val(info.major);
	}


	$('#instructorInfoForm').submit(function(event) {
		event.preventDefault();
			$.ajax({ // create subject
                    /* the route pointing to the post function */
                    url: '/admin/instructor/' + info.id_number,
                    type: 'PUT',
                    /* send the csrf-token and the input to the controller */
                    data:$(this).serialize(),
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if (data.success == true) {
                        	swal("Information updated", {
						      icon: "success",
						    }).then((value) => {
							  location.reload();
							});
                        }
                    }
            });
	});
});

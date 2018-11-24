$(document).ready(function () {
	let schedule_info;
	let schedule = $('.modal-title');
	let start_time = $('#start_time');
	let end_time = $('#end_time');
	let days = $('#days');
	let room = $('#room');
	let block = $('#block');
	let schedule_id = $('#scheduleId');


	// $(document).on('click','.course_checkbox',function () {
	// 		let course = $(this).val();
	// 		 if($(this).prop("checked") == true){
 //                $.get('/admin/subjects/'+course, function (data,status) {
	// 				console.log(data);
	// 			});
 //            } else {
 //            	console.log('unchecked');
 //            }
	// });

	$(document).on('click','#btnEditSchedule ', function () {
		rebaseSelectOption();
		schedule_info = $.parseJSON($(this).attr('params'));
		schedule.html(`<b>Edit ${schedule_info.subject}</b>`);
		$('#editSchedule').modal('toggle');
		setScheduleData();
	});

	$('#scheduleForm').submit(function (event) {
		event.preventDefault();
		 $.ajax({ // create subject
                    /* the route pointing to the post function */
                    url: '/admin/updateschedule',
                    type: 'PUT',
                    /* send the csrf-token and the input to the controller */
                    data: $(this).serialize(),
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if (data.success == true) {
                        	swal("Subject created",'Schedule update',"success")
							.then((value) => {
							  location.reload();
							});
                        } else {
                          swal({
							  title: "Please check all you input",
							  text: "This schedule is already exists please double check all the info",
							  icon: "error",
							  buttons: true,
							  dangerMode: true,
						 })
                        }
                    },
      		});
	});

	function rebaseSelectOption()
	{
		$('#subject_1').val(0).change();
		$('#subject_2').val(0).change();
		$('#subject_3').val(0).change();
		$('#subject_4').val(0).change();
	}

	function setScheduleData()
	{
		schedule_id.val(schedule_info.schedule_id);
		start_time.val(schedule_info.start_time).change();
		end_time.val(schedule_info.end_time).change();
		days.val(schedule_info.days).change();
		room.val(schedule_info.room).change();
		block.val(schedule_info.block[0]).change(); //get the id the of the block
		//get the level of the subject
		$('#subject_'+schedule_info.block[1]).val(schedule_info.subject).change();
	}
});

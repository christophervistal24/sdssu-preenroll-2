$(document).ready(function () {
	let schedule_info;
	let schedule = $('.modal-title');
	let start_time = $('#start_time');
	let end_time = $('#end_time');
	let days = $('#days');
	let room = $('#room');
	let block = $('#block');

	$('#csCheckBox ').click(function () {
		 if($(this).is(":checked")) {
           console.log('From CS checkbox check');
        } else {
           console.log('From CS checkbox unchecked');
        }
	});

	$('#ceCheckBox ').click(function () {
		if($(this).is(":checked")) {
           console.log('From CE checkbox check');
        } else {
           console.log('From CE checkbox unchecked');
        }
	});

	$('#btnEditSchedule ').click(function () {
		rebaseSelectOption();
		schedule_info = $.parseJSON($(this).attr('params'));
		schedule.html(`<b>Edit ${schedule_info.subject}</b>`);
		$('#editSchedule').modal('toggle');
		setScheduleData();
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
		start_time.val(schedule_info.start_time).change();
		end_time.val(schedule_info.end_time).change();
		days.val(schedule_info.days).change();
		room.val(schedule_info.room).change();
		block.val(schedule_info.block).change();
		$('#subject_'+schedule_info.block[0]).val(schedule_info.subject).change();
	}



});

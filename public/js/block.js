$(document).ready(function () {
	let course     = $('#course');
	let year       = $('#year');
	let block      = $('#blockName');
	let blockLimit = $('#blockLimit');
	let blockInfo;
	let action;

	$(document).on('click','#btnAddNewBlock' , function () {
        $('#blockForm')[0].reset();
        $('#modalTitle').html('<b>Add new block</b>');
		$('#blockModal').modal('toggle');
	});

	$(document).on('click','#btnEditBlock' , function () {
		blockInfo = $.parseJSON($(this).attr('params'));
		$('#blockForm').attr('data-action','edit');
		$('#blockBtn').html('Save changes');
		$('#modalTitle').html('Edit <b>' + blockInfo.year + blockInfo.course + blockInfo.block + '</b>');
		setValueForBlock();
		$('#blockModal').modal('toggle');
	});

	function setValueForBlock()
	{
		course.val(blockInfo.course);
		year.val(blockInfo.year);
		block.val(blockInfo.block);
		blockLimit.val(blockInfo.blockLimit);
	}


	$('#blockForm').submit(function (event) {
		event.preventDefault();
		action = $(this).attr('data-action');
		if (action == 'add') {
			$.ajax({
                    /* the route pointing to the post function */
                    url: '/admin/block',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data:$(this).serialize(),
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if (data.success == true) {
                        	swal("Successfully create new block", {
						      icon: "success",
						    }).then((value) => {
							});
                        }
                    },
                    error:function (xhr) {
                    	 $('#validation-errors').html('');
						   $.each(xhr.responseJSON.errors, function(key,value) {
						   	 $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
						 });
                    }
            });
		} else {
			var data = $(this).serializeArray(); // convert form to array
			data.push({name: "block_id", value: blockInfo.id});
			$.ajax({
                    /* the route pointing to the post function */
                    url: '/admin/upblock',
                    type: 'PUT',
                    /* send the csrf-token and the input to the controller */
                    data:$.param(data),
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if (data.success == true) {
                        	swal("Successfully create new block", {
						      icon: "success",
						    }).then((value) => {

							});
                        }
                    },
                    error:function (xhr) {
                    	 $('#validation-errors').html('');
						   $.each(xhr.responseJSON.errors, function(key,value) {
						   	 $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
						 });
                    }
            });
		}
	});

    (function(){
         if (document.URL.includes('/admin/')) {
            window.setInterval(function () {
                $.get( "/admin/blocks", function(data) {
                    $('#tableBlockBody').html('');
                    let text_color;
                    data.forEach(function(value,key) {
                        if (value.status == 'closed') {
                            text_color = 'text-danger';
                        } else {
                            text_color = 'text-success';
                        }
                        $('#tableBlockBody').append(`<tr>
                                <td class='text-center'>${value.level}${value.course}${value.block_name}</td>
                                <td class='text-center'>${value.no_of_enrolled}</td>
                                <td class='text-center'>${value.block_limit}</td>
                                <td class="text-center ${text_color}">${value.status.toUpperCase()}</td>
                                <td class='text-center'>
                                <button id="btnEditBlock" params={"id":${value.id},"course":"${value.course}","year":"${value.level}","block":"${value.block_name}","blockLimit":${value.block_limit},"no_of_enrolled":${value.no_of_enrolled}} class="btn btn-success border-0 rounded-0 text-white">EDIT</button></td>
                            </tr>`);
                        text_color = '';
                    });
                });
            },3000);
        }
    })();

    $(document).on('click','.btnBlockCategory', function () {
            let information = $.param($.parseJSON($(this).attr('data')));
            let this_block = $(this).html();
            $.get( `/student/schedule/${information}`, function(data) {
               if (data.schedules == undefined || data.schedules.length == 0) {
                    alert('No avaiable schedules for ' + this_block);
               } else {
                    $('#sortTrue').html('');
                    $('#sortTrue').append('<div class="text-center"><img id="loader" src="http://sdssu.be/storage/loader/load.gif" alt="" /></div>');
               }
            }).done(function (data) {
                setTimeout(function () {
                    $('#loader').remove();
                    data.schedules.forEach(function(value, key) {
                    if (value.pre_requisite_code == null) {
                        value.pre_requisite_code = 'No Prequisite';
                    }
                     $('#sortTrue').append(`<input onclick="return sample({'pre_requisite_code':'${value.pre_requisite_code}'});" data-id="${value.id}"  style="cursor:pointer; background:white;"  name="subjects[${value.subject_id}][ ${value.id}]" data-units="${value.units}" class="p-3 mb-3 form-control border-0 rounded-0 font-weight-bold js-remove" readonly value="${value.start_time}  -   ${value.end_time}  -  ${value.days}  -  ${value.room}  -   ${value.sub_description}  -   ${value.units}  Units">`);
                    });
                },800);
            });
    });

});

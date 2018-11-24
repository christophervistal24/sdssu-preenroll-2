$(document).ready(function () {
	let course     = $('#course');
	let year       = $('#year');
	let block      = $('#blockName');
	let blockLimit = $('#blockLimit');
	let blockInfo;
	let action;

	$(document).on('click','#btnAddNewBlock' , function () {
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
							  location.reload();
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
							  location.reload();
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
});

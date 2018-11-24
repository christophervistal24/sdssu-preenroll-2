$(document).ready(function () {
	let roomId     = $('#roomId');
	let roomNumber = $('#roomNumber');
	let modalTitle = $('#modalTitle');
	let btnSave    = $('#modalBtnSave');
	let action 		= $('#action');
	let room;

	$('#btnAddNewRoom').click(function () {
		$('#roomForm')[0].reset();
		$('#modalRoom').modal('toggle');
	});

	$('#btnEditRoom ').click(function () {
		room = $.parseJSON($(this).attr('params'));
		modalTitle.html('Edit room');
		action.val(room.room_id);
		roomNumber.val(room.room_number);
		$('#modalRoom').modal('toggle');
	});

	$('#btnDeleteRoom ').click(function () {
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		room = $.parseJSON($(this).attr('params'));
		swal({
		  title: "Are you sure?",
		  text: "Once deleted, you will not be able to recover this room!",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
		  	$.ajax({ // create subject
                    /* the route pointing to the post function */
                    url: '/admin/deleteroom/' + room.room_id,
                    type: 'DELETE',
                    /* send the csrf-token and the input to the controller */
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if (data.success == true) {
                        	swal("Oops! room "+room.room_number+" has been deleted!", {
						      icon: "success",
						    }).then((value) => {
							  location.reload();
							});
                        }
                    }
            });
		  } else {
		    swal("Room " + room.room_number + " file is safe!");
		  }
		});
	});

	$('#roomForm').submit(function (event) {
		event.preventDefault();
		if (action.val() == 'add') {
			$.ajax({ // create subject
                    /* the route pointing to the post function */
                    url: '/admin/listofrooms',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: $(this).serialize(),
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if (data.success == true) {
                        	swal("Room created",'',"success")
							.then((value) => {
							  location.reload();
							});
                        } else {
                        	swal({
							  title: "Given data fail",
							  text: 'Please double check all textfields',
							  icon: "error",
							  buttons: true,
							  dangerMode: true,
						 })
                        }
                    },
            });
		} else {
			$.ajax({ // create subject
                    /* the route pointing to the post function */
                    url: '/admin/listofrooms',
                    type: 'PUT',
                    /* send the csrf-token and the input to the controller */
                    data: $(this).serialize(),
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if (data.success == true) {
                        	swal("Room Updated",'',"success")
							.then((value) => {
							  location.reload();
							});
                        }
                    },
                    error:function(data) {
                    	swal({
							  title: "Please check fields",
							  text: '',
							  icon: "error",
							  buttons: true,
							  dangerMode: true,
						 })
                    }
      		});
		}
	});
});


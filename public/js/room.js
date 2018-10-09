let roomId     = document.querySelector('#roomId');
let roomNumber = document.querySelector('#roomNumber');
let modalTitle = document.querySelector('#modalTitle');
let btnSave    = document.querySelector('#modalBtnSave');
let token      = document.querySelector('meta[name="csrf-token"]').content;

let modalEdit = (room_id,room_number) => {
	$('#modalRoom').modal('toggle');
	roomId.value = room_id;
	modalTitle.innerHTML = 'Edit room';
	roomNumber.value = room_number;
	btnSave.innerHTML = 'Save';
};

let modalAdd = () => {
	document.querySelector('#roomForm').reset();
	$('#modalRoom').modal('toggle');
	roomId.value = 0;
	modalTitle.innerHTML = 'Add room';
	btnSave.innerHTML = 'Create';
};

let modalDelete = (room_id) => {
	$('#modalRoom').modal('toggle');
	roomId.value = room_id;
	modalTitle.innerHTML = 'Delete room';
	document.querySelector('#modalBody')
				.innerHTML = 'Are you sure you want to delete this room ?';
	btnSave.classList.remove('btn-primary');
	btnSave.classList.add('btn-danger');
	btnSave.innerHTML = 'Delete';
};

let createOrUpdate = () => {
	if (btnSave.innerHTML == 'Delete') {
		fetch(`/admin/deleteroom/${roomId.value}`,{
	      method: 'POST',
	      body: JSON.stringify({
	         _token:token,
	     }),
	      headers: new Headers({ "Content-Type": "application/json" })
	    })
	} else {
		fetch(`/admin/listofrooms`,{
	      method: 'POST',
	      body: JSON.stringify({
	         _token:token,
	         id:roomId.value,
	         room_number:roomNumber.value
	     }),
	      headers: new Headers({ "Content-Type": "application/json" })
	    })
	}
      location.reload();

};

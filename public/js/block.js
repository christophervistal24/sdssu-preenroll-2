let token      = document.querySelector('meta[name="csrf-token"]').content;
let course     = document.querySelector('#course');
let year       = document.querySelector('#year');
let block      = document.querySelector('#blockName');
let blockLimit = document.querySelector('#blockLimit');
let blockInfo;

let addNewBlock = () => {
	document.querySelector('#blockForm').reset();
	document.querySelector('#modalTitle').innerHTML = `Add block information`;
	document.querySelector('#blockBtn').innerHTML = `Add new block`;
	$('#blockModal').modal('toggle');
};

let editBlock = (block_info) => {
	document.querySelector('#blockForm').reset();
	blockInfo = block_info;
	document.querySelector('#modalTitle').innerHTML = `Edit block ${block_info.block}`;
	document.querySelector('#blockBtn').innerHTML = `Update block ${block_info.block}`;
	course.value     = block_info.course;
	year.value       = block_info.year;
	block.value      = block_info.block;
	blockLimit.value = block_info.blockLimit;
	$('#blockModal').modal('toggle');
}


let submitNewBlock = () => {
	try {
		fetch(`/admin/block/`,{
	      method: 'POST',
	      body: JSON.stringify({
				_token:token,
				id:blockInfo.id,
				course:course.value,
				block_limit:blockLimit.value,
				block_name:block.value,
				level:year.value
	     }),
	      headers: new Headers({ "Content-Type": "application/json" })
		}).then((res) => res.json())
            .then((data) =>{
            	console.log(data)
            	if (data.success == true) {
				swal("Good job!", `Block ${block.value.toUpperCase()}  successfully update`, "success")
				.then(() => {
						document.querySelector('#blockForm').reset()
						$('#blockModal').modal('toggle')
						location.reload()
					})
            	}
            })
	}
	catch(err) {
		fetch(`/admin/block/`,{
	      method: 'POST',
	      body: JSON.stringify({
				_token:token,
				course:course.value,
				block_limit:blockLimit.value,
				block_name:block.value,
				level:year.value
	     }),
	      headers: new Headers({ "Content-Type": "application/json" })
		}).then((res) => res.json())
            .then((data) =>{
            	console.log(data)
            	if (data.success == true) {
				swal("Good job!", `Block ${block.value.toUpperCase()} successfully create`, "success")
				.then(() => {
						document.querySelector('#blockForm').reset()
						$('#blockModal').modal('toggle')
						location.reload()
					})
            	}
            })
	}


};

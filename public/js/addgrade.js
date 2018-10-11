let displayModalForGrade = (student) => {
	document.querySelector('#modalTitle').innerHTML = `Add grade for ${student.fullname}`;
	//swap
	console.log(student);
	// $('#modalAddGrade').modal('toggle');
};

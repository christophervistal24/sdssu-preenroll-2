let studentInfo = {};
let token      = document.querySelector('meta[name="csrf-token"]').content;
let studentGrade = document.querySelector('#studentGrade');

let displayModalForGrade = (student) => {
	document.querySelector('#modalTitle').innerHTML = `Add grade for ${student.fullname}`;
	studentInfo = student;
	$('#modalAddGrade').modal('toggle');
};


let addGrade = () => {
	fetch(`/instructor/addstudentgrade/`,{
	      method: 'POST',
	      body: JSON.stringify({
				_token:token,
				student_id:studentInfo.id,
				student_grade:studentGrade,
				student_subject_id:studentInfo.student_subject_id,
				student_grade:studentGrade.value
	     }),
	      headers: new Headers({ "Content-Type": "application/json" })
		})
};

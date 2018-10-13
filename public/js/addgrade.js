let studentInfo = {};
let token      = document.querySelector('meta[name="csrf-token"]').content;
let studentGrade = document.querySelector('#studentGrade');

let displayModalForGrade = (student) => {
	studentInfo = student;
	let action = document.querySelector('#btnModal').innerHTML;
	if (action.includes('Add')) {
			document.querySelector('#modalTitle').innerHTML = `Add grade for ${student.fullname}`;
	} else {
			studentGrade.value = student.remarks;
			document.querySelector('#modalTitle').innerHTML = `Edit grade for ${student.fullname}`;
	}
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
		}).then((res) => res.json())
            .then((data) =>{
            	if (data.student_grade == 5.0) {
            		document.querySelector('#studentGradeColumn').classList.add('text-danger')
	            	document.querySelector('#studentGradeColumn').innerHTML = data.student_grade
            	} else {
            		document.querySelector('#studentGradeColumn').classList.add('text-black')
	            	document.querySelector('#studentGradeColumn').innerHTML = data.student_grade
            	}
            	console.log(data)
            	// location.reload()
            });
};


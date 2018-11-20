let studentInfo;
// let token      = document.querySelector('meta[name="csrf-token"]').content;
let studentGrade = document.querySelector('#studentGrade');

let displayModalForGrade = (student) => {
	studentInfo = student;
	studentGrade.value = '';
	let action = document.querySelector('#btnModal').innerHTML.toLowerCase();
	if (action.includes('add')) {
		document.querySelector('#modalTitle').innerHTML = `Add grade for ${studentInfo.fullname}`;
	} else {
		document.querySelector('#modalTitle').innerHTML = `Edit grade for ${studentInfo.fullname}`;
		(studentInfo.grade != null ) ? studentGrade.value = studentInfo.grade : '';
	}
	$('#modalAddGrade').modal('toggle');
};


let addGrade = () => {
	fetch(`/instructor/addstudentgrade/`,{
	      method: 'POST',
	      body: JSON.stringify({
				_token:token,
				student_id:studentInfo.id,
				student_subject_id:studentInfo.subject,
				student_grade:studentGrade.value,
				block:studentInfo.block,
				year:studentInfo.year
	     }),
	      headers: new Headers({ "Content-Type": "application/json" })
		}).then((res) => res.json())
            .then((data) =>{
          		location.reload()
            });
};


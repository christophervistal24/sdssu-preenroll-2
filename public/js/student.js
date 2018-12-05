$(document).ready(function () {
    let studentInfo = {};

    $(document).on('click','#btnEditInfo' , function () {
        studentInfo = $.parseJSON($(this).attr('params'));
        setStudentInfo();
        $('#editStudentInfo').modal('toggle');
    });
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    function setStudentInfo()
    {
        $('#parentMobileNumber').val(studentInfo.parent_mobile);
        $('#studentMothersname').val(studentInfo.mothers_name);
        $('#studentFathersname').val(studentInfo.fathers_name);
        $('#studentCourse').val(studentInfo.course);
        $('#studentYear').val(studentInfo.year);
        $('#studentMobileNumber').val(studentInfo.mobile);
        $('#studentAddress').val(studentInfo.address);
        $('#studentGender').val(studentInfo.gender);
        $('#studentIdNumber').val(studentInfo.id_number);
        $('#studentFullname').val(studentInfo.fullname);
    }

    $('#editStudentForm').submit(function (e) {
        e.preventDefault();
        $.ajax({ // create subject
                    /* the route pointing to the post function */
                    url: '/admin/editstudent/' + studentInfo.id_number,
                    type: 'PUT',
                    data:$(this).serialize(),
                    /* send the csrf-token and the input to the controller */
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                            if (data.success  == true) {
                                swal("Information updated!",'',"success")
                                .then((value) => {
                                  location.reload();
                                });
                            }
                    }
            });
    });
});

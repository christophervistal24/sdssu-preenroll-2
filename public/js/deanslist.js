$(document).ready(function () {
    (function(){
        let last_record_date = window.myApp.deanslist_last;
        window.setInterval(function () {
             $.get( "/admin/api/deanslist/"+last_record_date,function(data) {

             }).done(function (data) {
                if (data.success == true) {
                    last_record_date = data.last_record.date;
                    data.data.forEach(function (value , key) {
                        alert('New student for deans list ID No.' + value.student_id_number);
                    });
                }
             });
        },2000);
    })();
});
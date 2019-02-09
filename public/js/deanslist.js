// $(document).ready(function () {
//     if (document.URL.includes('/admin/')) {
//         (function(){
//             let last_record_date = window.myApp.deanslist_last;
//             window.setInterval(function () {
//                  $.get( "/admin/api/deanslist/"+last_record_date,function(data) {

//                  }).done(function (data) {
//                     if (data.success == true) {
//                         last_record_date = data.last_record.date;
//                         data.data.forEach(function (value , key) {
//                             alert('New student for deans list ID No.' + value.student_id_number);
//                         });
//                         $('#noOfDeansList').html(data.count);
//                     } else if (data.success == false) {
//                         last_record_date = data.last_record.date;
//                     }
//                  });
//             },2000);
//         })();
//     }
// });
@inject('deans_list_model','App\DeansList')
<!DOCTYPE html>
<html class="no-js h-100" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>SDSSU</title>
        <script>
          window.myApp = {
            'deanslist_last' : '{{$deans_list_model::all()->last()->created_at}}'
          };
        </script>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
        <script src="/js/third_party/sweetalert.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
        <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="/js/third_party/css/bootstrap4.min.css" >
        <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="/dashboard/styles/shards-dashboards.1.1.0.min.css">
        <link rel="stylesheet" href="/dashboard/styles/extras.1.1.0.min.css">
        <script async defer src="/js/third_party/button.js"></script>
        <script src="/js/third_party/sortable.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">


        <style>
        table.dataTable thead th, table.dataTable thead td { border-color: #ddd!important; }
        table.dataTable.no-footer {border-color: #ddd!important;}
        </style>
    </head>
    <body class="h-100">
        <div class="container-fluid">
            <div class="row">
                @include('templates-dashboard.sidebar')
                <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                    @yield('content')
                </main>
            </div>
        </div>
 <!-- The Modal -->
<div class="modal fade" id="semesterInputPasswod">
  <div class="modal-dialog">
    <div class="modal-content rounded-0">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <label>Password : </label>
          <input id="password" type="password" name="password" class="form-control">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnChangeSem">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

        <script src="/js/room.js"></script>
         <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
        <script src="/dashboard/scripts/extras.1.1.0.min.js"></script>
        <script src="/dashboard/scripts/shards-dashboards.1.1.0.min.js"></script>
        <script src="/dashboard/scripts/app/app-blog-overview.1.1.0.js"></script>
        <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script>
        $(document).ready( function () {
            $('#tables').DataTable({ "order": [[ 0, "desc" ]]});
            $('#student-table').DataTable({ "order": [[ 0, "asc" ]]});
            $('#block_tables').DataTable({
             "order": [[ 4, "asc" ]],
             "bPaginate": false,
             "bInfo" : false,
             "lengthChange": false
           });
            $('#sched-table').DataTable({
                "ordering": false,
                 "aLengthMenu": [[2, 50, 75, -1], [2, 50, 75, "All"]],
                 "iDisplayLength": -1,
                 "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false
            });
            $('#deleteTables').DataTable({
                "aLengthMenu": [[2, 50, 75, -1], [2, 50, 75, "All"]],
                "iDisplayLength": 2
            });

            $('#subjectTable').DataTable({
                "order": [[ 4, "asc" ]]
            });

        });
        </script>
        @if (\Request::path() == 'admin/schedule'  || \Request::path() == 'admin/instructors' || \Request::path() == 'admin/scheduling')
        @elseif(\Request::path() == 'admin/subjects')
               <script src="/js/subjects.js"></script>
        @elseif(\Request::path() == 'admin/index')
                <script>
                    let listBox = document.querySelector('#semester');
                    let PrevValue = null;
                    let token = document.querySelector('meta[name="csrf-token"]').content;
                    listBox.addEventListener('focus', () => {
                        PrevValue = listBox.value;
                    });

                    listBox.addEventListener('change' , () => {
                       let confirmation = confirm('Would you like to change the semester?');
                       if(confirmation)
                       {
                          $('#password').val('')
                          $('#semesterInputPasswod').modal('toggle');
                       } else {
                            listBox.value = PrevValue;
                       }
                    });
                    $(document).on('click','#btnChangeSem' , function () {
                        fetch(`/admin/index`,{
                              method: 'POST',
                              body: JSON.stringify({
                                 _token:token,
                                semester_id:listBox.value ,
                                password:$('#password').val(),
                             }),
                              headers: new Headers({ "Content-Type": "application/json" })
                            })
                           .then((res) => res.json())
                            .then((data) => {
                                if(data.success == true)
                                {
                                      $('#semesterInputPasswod').modal('toggle');
                                      swal("Good job!", `Semester changed`, "success")
                                } else {
                                      listBox.value = data.value;
                                      swal("Wrong password!", ``, "error")
                                }
                            })
                    });
                </script>
        @endif
        <script src="/js/addgrade.js"></script>
        <script src="/js/block.js"></script>
        <script src="/js/schedule.js"></script>
        <script src="/js/instructor.js"></script>
        <script src="/js/pre_dragged.js"></script>
        <script src="/js/print-with-range.js"></script>
        <script src="/js/student.js"></script>
        <script src="/js/deanslist.js"></script>
      @if (str_contains(request()->fullUrl(),'assign'))
       <script>
            // sort: true
        Sortable.create(sortTrue, {
            animation:200,
          group: "sorting",
          sort: true,
            onMove: function (evt) {
            if (evt.to.childElementCount > 0) {
                return false;
            }
        }
        });

        // sort: false
        Sortable.create(sortFalse, {
            animation:200,
          group: "sorting",
          sort: false,
        });

        </script>
      @endif
    </body>
</html>

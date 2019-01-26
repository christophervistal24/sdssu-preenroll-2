@extends('templates-dashboard.master')
@section('content')
<div class="main-navbar sticky-top bg-white">
    <!-- Main Navbar -->
    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
        <form action="" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
            <div class="input-group input-group-seamless ml-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                    </div>
                </div>
                <input class="navbar-search form-control" type="text" placeholder="" aria-label="Search"> </div>
            </form>
            <ul class="navbar-nav border-left flex-row ">
                <li class="nav-item border-right dropdown notifications">
                    <a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="nav-link-icon__wrapper">
                            <i class="material-icons">&#xE7F4;</i>
                            <span class="badge badge-pill badge-danger">2</span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">
                            <div class="notification__icon-wrapper">
                                <div class="notification__icon">
                                    <i class="material-icons">&#xE6E1;</i>
                                </div>
                            </div>
                            <div class="notification__content">
                                <span class="notification__category">Analytics</span>
                                <p>Your website’s active users count increased by
                                    <span class="text-success text-semibold">28%</span> in the last week. Great job!</p>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="notification__icon-wrapper">
                                    <div class="notification__icon">
                                        <i class="material-icons">&#xE8D1;</i>
                                    </div>
                                </div>
                                <div class="notification__content">
                                    <span class="notification__category">Sales</span>
                                    <p>Last week your store’s sales count decreased by
                                        <span class="text-danger text-semibold">5.52%</span>. It could have been worse!</p>
                                    </div>
                                </a>
                                <a class="dropdown-item notification__all text-center" href="#"> View all Notifications </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                              @if(request()->is('parent/*'))
                              <img class="user-avatar rounded-circle mr-2" src="{{url("storage/profile/no_image.png")}}" alt="User Avatar">
                                @else
                                <img class="user-avatar rounded-circle mr-2" src="{{url("storage/profile/$user_info->profile")}}" alt="User Avatar">
                              @endif
                                
                                @if (request()->is('admin/*'))
                                    <span class="d-none d-md-inline-block">{{ $user_info->name }}</span>
                                @elseif (request()->is('parent/*'))
                                    <span class="d-none d-md-inline-block">{{ $user_info->mothername }}</span>
                                @else
                                  <span class="d-none d-md-inline-block">{{ $user_info->fullname }}</span>
                                @endif


                            </a>
                            <div class="dropdown-menu dropdown-menu-small">
                                <div class="dropdown-divider"></div>
                                @if (request()->is('admin/*'))
                                <a class="dropdown-item text-danger" href="{{ url('/admin/logout') }}">
                                    @else
                                <a class="dropdown-item text-danger" href="{{ url('/student/logout') }}">
                                @endif
                                <i class="material-icons text-danger">&#xE879;</i> Logout </a>
                            </div>
                        </li>
                    </ul>
                    <nav class="nav">
                        <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                            <i class="material-icons">&#xE5D2;</i>
                        </a>
                    </nav>
                </nav>
            </div>
            <!-- / .main-navbar -->
            <div class="main-content-container card rounded-0 container-fluid px-4">
                <!-- Page Header -->
                <div class="container">
                </div>
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    </div>
                </div>
                @php
                $total_units = 0;
                $sum = 0;
                $count = 0;
                @endphp
                @include('errors.error')
                @include('success.success-message')
                <div class="row text-center">
                    <div class="col-md-4 "><span class="font-weight-bold">{{ ($student->id_number) }}</span></div>
                    <div class="col-md-4 "><span class="font-weight-bold"> {{ $student->fullname }}</span></div>
                    <div class="col-md-4 "><span class="font-weight-bold">{{ ucwords($student->gender) }}</span></div>
                </div>
                <div class="row text-center">
                    <div class="col-md-4"><span class="font-weight-bold">Student No.</span></div>
                    <div class="col-md-4"><span class="font-weight-bold">Fullname</span></div>
                    <div class="col-md-4"><span class="font-weight-bold">Gender</span></div>
                </div>
                <br>
                <div class="row text-left">
                    <div class="col-md-4"><span class="font-weight-bold">Course Code : BS{{ $student->course->course_code }}</span></div>
                    <div class="col-md-4 text-center"><span class="font-weight-bold">Department Code : CECST</span></div>
                    <div class="col-md-4 text-right"><span class="font-weight-bold">Year Level : {{ digitToYearLevel($student->year) }}</span></div>
                </div>
                @if (request()->is('admin/*'))
                    <div class="fixed-bottom">
                        <button id="withRange" data-id_number="{{$student->id_number}}" data-course="{{ $student->course->course_code}}" class="btn btn-success rounded-0 float-right"><b>PRINT ALL</b></button>
                   </div>
                @endif
                <br>

                  @foreach ($grades as $key => $grade)
                  <div id="{{$key}}" class="grades">
                  @php
                   $count     = 0;
                   $gpa       = 0;
                   $semestral = 0;
                   $gpa       = array_sum((array_column($grades[$key],'remarks')));
                   $count     = count(array_column($grades[$key],'subject_id'));
                   $semestral = $gpa / $count;
                  @endphp
                   <div class="row">
                    <div class="col-md-6 text-left">
                      <!--Semester-->
                      <h5 class="text-capitalize"><span class="font-weight-bold">{{str_replace('_',' ',$key)}}</span></h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <span class="font-weight-bold ">Semestral GPA : {{ number_format($semestral,1,'.',',') }} </span>
                    </div>
                  </div>
                   @php
                      $total_units = 0;
                   @endphp
                      @if ($loop->last)
                          <div><a href="/admin/student/print/grade/{{ $student->id_number }}/{{$grade[0]->subject->semester}}/{{$grade[0]->subject->year}}/report" class="btn btn-secondary rounded-0 float-right">PRINT</a>
                          </div>
                            <table class="table table-inverse" width="100%">
                              <thead>
                                 <tr>
                                    <th>Subject Name</th>
                                    <th>Subject Description</th>
                                    <th>Section</th>
                                    <th class="text-center">Time</th>
                                    <th>Days</th>
                                    <th>Room</th>
                                    <th class="text-center">Grade</th>
                                    <th class="text-right">GCompl Units</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($grade as $grade_sub)
                                <tr>
                                  <td class="border-0">{{$grade_sub->subject->sub}}</td>
                                  <td class="border-0">
                                    {{$grade_sub->subject->sub_description}}

                                    </td>
                                     <td class="text-center border-0">
                                      {{
                                      @$grade_sub->subject->schedule_sub->block_schedule->level .
                                      @$grade_sub->subject->schedule_sub->block_schedule->course .
                                      @$grade_sub->subject->schedule_sub->block_schedule->block_name
                                      }}
                                    </td>
          <td class="text-center border-0"  width="20%">
                  @foreach ($student->schedules as $s)
                    @if ($grade_sub->subject_id == $s->subject_id)
                      {{$s->start_time}} - {{$s->end_time}}
                    <br>
                    @endif
                  @endforeach
          </td>

           <td class="text-center border-0" >
                  @foreach ($student->schedules as $s)
                    @if ($grade_sub->subject_id == $s->subject_id)
                      {{$s->days}}
                    <br>
                    @endif
                  @endforeach
          </td>
           <td class="text-center border-0" >
                  @foreach ($student->schedules as $s)
                    @if ($grade_sub->subject_id == $s->subject_id)
                      {{$s->room}}
                    <br>
                    @endif
                  @endforeach
            </td>
           <td class="text-right border-0">{{(@$grade_sub->remarks) ? $grade_sub->remarks : 'NG'}}</td>
                                    <td class="text-right border-0">{{@$grade_sub->subject->units}}</td>



        @php
          $total_units += @$grade_sub->subject->units;
        @endphp
                                </tr>
                              @endforeach
                               <td colspan="8" class="text-right">Total Credited Units : {{@$total_units}}</td>
                            </table>
                        @else
                        <div><a href="/admin/student/print/grade/{{ $student->id_number }}/{{$grade[0]->subject->semester}}/{{$grade[0]->subject->year}}" class="btn btn-secondary rounded-0 float-right">PRINT</a>
                          </div>
                        <table class="table" width="100%">
                          <thead>
                            <tr>
                              <th>Subject Name</th>
                              <th>Subject Description</th>
                              <th class="text-center">Grade</th>
                              <th class="text-right">GCompl Units</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($grade as $grade_sub)
                            <tr>
                              <td>{{$grade_sub->subject->sub}}</td>
                              <td>{{$grade_sub->subject->sub_description}}</td>
                              @if ($grade_sub->remarks > 3)
                                  <td class="text-center text-danger">{{($grade_sub->remarks) ? $grade_sub->remarks : 'NG'}}</td>
                                  @else
                                  <td class="text-center">{{($grade_sub->remarks) ? $grade_sub->remarks : 'NG'}}</td>
                              @endif
                              @php $total_units += $grade_sub->subject->units; @endphp
                              <td class="text-right">{{$grade_sub->subject->units}}</td>
                            </tr>
                            @endforeach
                              <tr ><td colspan="8" class="text-right"><span class="font-weight-bold">Total Credited Units : {{$total_units}}</span></td></tr>
                          </tbody>
                        </table>
                      @endif
                  @endforeach
                </div>
                <br>
        </div>
    </div>
</div>
@include('templates-dashboard.modal-range')
@endsection

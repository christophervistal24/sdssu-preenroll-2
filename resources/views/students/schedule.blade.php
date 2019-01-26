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
                <input class="navbar-search form-control" type="text"  aria-label="Search"> </div>
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
                                <img class="user-avatar rounded-circle mr-2" src="{{url("storage/profile/$user_info->profile")}}" alt="User Avatar">
                                <span class="d-none d-md-inline-block">{{ $user_info->fullname }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small">
                                <a class="dropdown-item text-danger" href="{{ url('/student/logout') }}">
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

                <div class="main-content-container container-fluid px-4 card ">
                    <!-- Page Header -->
                    <div class="page-header row no-gutters py-4">
                        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                            <span class="text-uppercase page-subtitle">Your schedules</span>
                        </div>
                    </div>
                    <!-- End Page Header -->
                    <!-- Small Stats Blocks -->
                    <div class="row">

                            <div class="col-lg-4 text-left">
                             <span class="font-weight-bold">Student No : {{ hyphenate($student_information->id_number) }} </span>
                            </div>
                             <div class="col-lg-4 text-left">
                                 <span class="font-weight-bold">Student Name : {{ ucwords($student_information->fullname) }}</span>
                            </div>
                             <div class="col-lg-4 text-right">
                                 <span>Address :  {{ $student_information->address }}</span>
                            </div>
                              <div class="col-lg-12 text-left border-bottom">
                                 <span>Year Level : {{ digitToYearLevel($student_information->year) }}    </span>
                            </div>
                            <div class="col-lg-12 text-left">
                                <span>Course : {{  $student_information->course->course_name }}
                             </span>
                            </div>
                            <div class="col-lg-12 text-left border-bottom">
                                <span>Department : COLLEGE OF ENGINEERING, COMPUTERING STUDIES AND TECHNOLOGY
                             </span>
                            </div>
                            <div class="col-lg-12 text-left border-bottom">
                                <span>Department/Grant : <span class="font-weight-bold">(SCHOLARSHIP)</span>
                             </span>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <a href="/student/schedule/print/{{ $student_information->id_number }}" class="mb-2 float-right btn btn-primary">PRINT</a>
                            <table id="sched-table" class="table table-bordered">
                            <thead class="text-center">
                                <tr class="p-0"><th colspan="8" class="p-0 border-bottom-0 pt-1"><h5 class="text-center">CLASS SCHEDULE</h5></th></tr>
                                <th class="border-right-0">SUB. NAME</th>
                                <th class="text-left border-right-0">SUBJECT DESCRIPTION</th>
                                <th class="border-right-0">SECTION</th>
                                <th class="border-right-0">UNITS</th>
                                <th class="border-right-0">ROOM</th>
                                <th class="border-right-0">DAYS</th>
                                <th class="border-right-0">TIME</th>
                                <th>PAY UNITS</th>
                            </thead>
                            <tbody>
                                @foreach ($student_information->schedules as $schedule)
                                    <tr>
                                        <td class="text-left border-right-0">{{ $schedule->subject->sub }}</td>
                                        <td class="text-left border-right-0">{{ $schedule->subject->sub_description }}</td>
                                        <td class="text-center border-right-0">{{ $schedule->block_schedule->level . $schedule->block_schedule->course . $schedule->block_schedule->block_name }}</td>
                                        <td class="text-center border-right-0">{{ number_format($schedule->subject->units, 1, '.', ',')}}</td>
                                        <td class="text-center border-right-0">{{ $schedule->room }}</td>
                                        <td class="text-center border-right-0">{{ $schedule->days }}</td>
                                        <td class="text-center font-weight-bold text-sm border-right-0">{{ $schedule->start_time . ' - ' . $schedule->end_time  }}</td>
                                        @php
                                            @$units += $schedule->subject->units;
                                        @endphp
                                        <td class="text-center border-right-0">{{ number_format($schedule->subject->units, 1, '.', ',')}}</td>

                                    </tr>
                                @endforeach
                                @if (isset($units))
                                    <td colspan="8" class="text-right">Total units : {{ $units }}</td>
                                @endif
                            </tbody>
                        </table>
                        <br>
                        </div>
                    </div>
            </div>
@endsection

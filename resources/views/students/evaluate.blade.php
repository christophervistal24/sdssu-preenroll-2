@extends('templates-dashboard.master')
@section('content')
<div class="main-navbar sticky-top bg-white">
      <div class="main-navbar sticky-top bg-white">
        <!-- Main Navbar -->
        <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
            <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                <div class="input-group input-group-seamless ml-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            
                        </div>
                    </div>
                    <input class="navbar-search form-control" type="text"  aria-label="Search"> </div>
                </form>
                <ul class="navbar-nav border-left flex-row ">
                    <li class="nav-item border-right dropdown notifications">
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
                                    <img class="user-avatar rounded-circle mr-2" src="/dashboard/images/avatars/0.jpg" alt="User Avatar">
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
            <div class="main-content-container container-fluid px-4 card">
                <!-- Page Header -->
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                        <span class="text-uppercase page-subtitle">Dashboard</span>
                    </div>
                </div>
                <!-- End Page Header -->
                <!-- Small Stats Blocks -->
                <div class="row">
                    <div class="col-md-12">
                        <table id="sched-table" class="table table-bordered table-responsive" >
                            <thead class="text-center">
                               <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Grades</th>
                                <th>Semester</th>
                                <th>Units</th>
                               </tr>
                            </thead>
                            <tbody>
                                @foreach ($student->student_subjects as $student_sub)
                                    <tr>
                                        <th>{{ $student_sub->sub }}</th>
                                        <th>{{ $student_sub->sub_description }}</th>
                                            @foreach ($student->grades as $grade)
                                                @if ($grade->subject_id == $student_sub->id)
                                                        @if ($grade->remarks >= 3)
                                                                <th class="text-center text-danger">{{ $grade->remarks }}</th>
                                                        @else
                                                                <th class="text-center text-success">{{ $grade->remarks }}</th>
                                                        @endif
                                                @endif
                                            @endforeach
                                        </th>
                                        <th class="text-center">{{ $student_sub->semester }}</th>
                                        <th class="text-center">{{ $student_sub->units }}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endsection

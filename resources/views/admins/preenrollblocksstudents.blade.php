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
                                <span class="d-none d-md-inline-block">{{ $user_info->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small">
                                <a class="dropdown-item text-danger" href="{{ url('/admin/logout') }}">
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
            <div class="main-content-container container-fluid px-4 card" style="border-radius: 0px">
                <!-- Page Header -->
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                        <span class="text-uppercase page-subtitle">Dashboard</span>
                    </div>
                </div>
                <!-- End Page Header -->
                <!-- Small Stats Blocks -->
                <div class="row">
                    <h4 class="text-muted ml-2">List of all students in <b>{{$block_with_student->level}}{{$block_with_student->course}}{{$block_with_student->block_name}}</b></h4>
                    <div class="container">

                        <table id="tables" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">ID Number</th>
                                    <th class="text-center">Fullname</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Mobile Number</th>
                                    <th class="text-center">Year</th>
                                    <th class="text-center">Course</th>
                                </tr>
                            </thead>
                            <tbody id="tableBlockBody">
                                @foreach ($block_with_student->students as $student)
                                    <tr>
                                    <th class="text-center">{{ hyphenate($student->id_number) }}</th>
                                    <td>{{ ucwords($student->fullname) }}</td>
                                    <td class="text-center">{{ ucwords($student->gender) }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td>{{ $student->mobile_number }}</td>
                                    <td class="text-center">{{ digitToYearLevel($student->year) }}</td>
                                    <td class="text-center">BS{{ $student->course->course_code }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
           
            @endsection

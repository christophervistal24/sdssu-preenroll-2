@extends('templates-dashboard.master')
@section('content')
<div class="main-navbar sticky-top bg-white">
    <!-- Main Navbar -->
    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
        <form action="" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
            <div class="input-group input-group-seamless ml-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
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
                                <img class="user-avatar rounded-circle mr-2" src="/dashboard/images/avatars/0.jpg" alt="User Avatar">
                                <span class="d-none d-md-inline-block">{{ $user_info->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small">
                                <a class="dropdown-item" href="user-profile-lite.html">
                                <i class="material-icons">&#xE7FD;</i> Profile</a>
                                <a class="dropdown-item" href="components-blog-posts.html">
                                <i class="material-icons">vertical_split</i> Blog Posts</a>
                                <a class="dropdown-item" href="add-new-post.html">
                                <i class="material-icons">note_add</i> Add New Post</a>
                                <div class="dropdown-divider"></div>
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
            <div class="main-content-container card rounded-0 container-fluid px-4">
                <!-- Page Header -->
                <div class="container">
                </div>
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    </div>
                </div>
               @include('errors.error')
               @include('success.success-message')
                <div class="row text-center">
						<div class="col-md-4 "><span class="font-weight-bold">{{ $student->id_number }}</span></div>
						<div class="col-md-4 "><span class="font-weight-bold"> {{ $student->fullname }}</span></div>
						<div class="col-md-4 "><span class="font-weight-bold">(GENDER HERE)</span></div>
                </div>
                <div class="row text-center">
						<div class="col-md-4"><span class="font-weight-bold">Student No.</span></div>
						<div class="col-md-4"><span class="font-weight-bold">Fullname</span></div>
						<div class="col-md-4"><span class="font-weight-bold">Gender</span></div>
                </div>
                <br>
                <div class="row text-left">
						<div class="col-md-3"><span class="font-weight-bold">Course Code : BS{{ $student->course->course_code }}</span></div>
						<div class="col-md-3"><span class="font-weight-bold">Department Code : CECST</span></div>
						<div class="col-md-3"><span class="font-weight-bold">Year Level : {{ $student->level }}</span></div>
						<div class="col-md-3"><span class="font-weight-bold">Semestral GPA : (Lorem)</span></div>
                </div>
                <br>
                {{-- id="sched-table" --}}
                <table  class="table">
                	<thead>
                		<tr>
                			<th>Subject Name</th>
                			<th>Subject Description</th>
                			<th>Section</th>
                			<th class="text-center">Time</th>
                			<th>Day</th>
                			<th>Room</th>
                			<th>Grade</th>
                			<th>GCompl Units</th>
                		</tr>
                	</thead>
                	<tbody>
                		@php $total_units = 0; @endphp
                		@foreach ($student->schedules as $s)
                		<tr>
                			<th>{{ $s->subject->sub }}</th>
                			<th>{{ $s->subject->sub_description }}</th>
                			<th>{{ $s->block_schedule->level . '' . $s->block_schedule->course . '' . $s->block_schedule->block_name }}</th>
                			<th>{{ $s->start_time . ' - ' . $s->end_time }}</th>
                			<th>{{ $s->days }}</th>
                			<th class="text-center">{{ $s->room }}</th>
                			<th>
                				@foreach ($student->grades as $grade)
                					@if ($grade->id == $s->subject->id)
                						{{ $grade->remarks }}
                					@endif
                				@endforeach
                			</th>
                			@php
                				$total_units += $s->subject->units
                			@endphp
                			<th class="text-right">{{ number_format($s->subject->units, 1, '.', ',') }}</th>
                		</tr>
                		@if ($loop->last)
                			<tr>
                				<th colspan="8" class="text-right">Total Credited Units : {{ number_format($total_units,1,'.',',') }}</th>
                			</tr>
                		@endif
                		@endforeach
                	</tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    @endsection

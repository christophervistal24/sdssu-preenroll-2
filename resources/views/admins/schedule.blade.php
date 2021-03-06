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
            <div class="main-content-container container-fluid px-4 card p-4 rounded-0">
                <!-- Page Header -->
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                        <span class="text-uppercase page-subtitle">Dashboard</span>
                    </div>
                </div>
                <!-- End Page Header -->
                <!-- Small Stats Blocks -->
                <div class="row">
                    <h3 class="text-muted ml-2">List of all schedules</h3>
                    <div class="container-fluid">
                        <table id="tables" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Days</th>
                                    <th class="text-center">Room</th>
                                    <th class="text-center">Block</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Instructors</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                <tr>
                                    <td class="text-center">{{ $schedule->start_time . ' - ' . $schedule->end_time }}</td>
                                    <td class="text-center">{{ $schedule->days }}</td>
                                    <td class="text-center">{{ $schedule->room }}</td>
                                    <td class="text-center">
                                        {{
                                            $schedule->block_schedule['level'] .
                                            $schedule->block_schedule['course'] .
                                            $schedule->block_schedule['block_name']
                                        }}
                                    </td>
                                    <td>{{ $schedule->subject->sub_description }}</td>
                                    <td class="text-center">
                                        @foreach ($schedule->instructor_name_only as $instructor)
                                        {{ ucwords($instructor->name) }}
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <button id="btnEditSchedule" params='{{
                                        json_encode(
                                            [
                                                'schedule_id' => $schedule->id,
                                                'start_time'  => $schedule->start_time,
                                                'end_time'    => $schedule->end_time,
                                                'days'        => $schedule->days,
                                                'room'        => $schedule->room,
                                                'block'       => [$schedule->block_schedule['id'] , $schedule->block_schedule['level']],
                                                'subject'     => $schedule->subject->id,
                                            ]
                                        )
                                        }}' class="btn btn-success"><i class="material-icons">edit</i> EDIT</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @include('templates-dashboard.modal-edit-schedule')
 @endsection

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
                                <span class="d-none d-md-inline-block">{{ $user_info->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small">
                                <a class="dropdown-item text-danger" href="{{ url('/assistantdean/logout') }}">
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
      <!-- / .main-navbar -->
      <div class="main-content-container container-fluid px-4 card border-0 rounded-0">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
          <div class="col-12 col-sm-2 offset-10 text-sm-left mb-0 float-right">
          </div>
        </div>
        <div class="row">
          <div class="list-group col-md-6 p-4 card rounded-0" style=" height : auto;">
            <span class="text-uppercase page-subtitle text-center">List of instructors</span>
            <hr>
            <div id="sortTrue" class="list-group col-md-12" style="cursor:pointer;">
              @foreach ($instructors as $instructor)
              <input style="cursor:pointer;" name="instructor_name" class="p-3  mb-2 form-control border-0 rounded-0 font-weight-bold" readonly value="{{ ucwords($instructor->name) }}">
              @endforeach
            </div>
          </div>
          <div class="list-group col-md-6 p-4 card rounded-0" style=" height : auto;">
            <form method="POST" action="/assistantdean/assign/{{ $schedule_info->id }}{{ isset($schedule_info2->id) ? '/' . $schedule_info2->id : null }}" style="height :50vh;">
              @csrf
            <span class="text-uppercase page-subtitle text-center">Subject : {{ $schedule_info->subject->sub_description }}</span>

              <input type="submit" value="Assign" class="rounded-0 border-0 float-right btn btn-primary">
              <hr>
              <div id="sortFalse" class="list-group col-md-12 bg-faded p-4" style="height:150vh;">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection

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
            <div class="main-content-container container-fluid px-4 card rounded-0">
                <!-- Page Header -->
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                        <span class="text-uppercase page-subtitle">Add student</span>
                    </div>
                </div>
                <!-- End Page Header -->
                <!-- Small Stats Blocks -->
                <div class="">
                    <form method="POST" autocomplete="off">
                        @include('errors.error')
                        @include('success.student-success')
                        <div class="form row">
                            @csrf
                            <div class="col-md-6 offset-3">
                                <p>Student Information</p>
                                <label>Student ID No. : </label>
                                <input type="text" value="{{ old('id_number') }}" name="id_number"  class="form-control" placeholder="e.g 1501755">
                                <br>
                                <label>Student Fullname : </label>
                                <input type="text" name="student_fullname"  value="{{ old('student_fullname') }}" class="form-control" placeholder="e.g Christian De Leon">
                                <br>
                                <label>Course : </label>
                                <select name="course"  id="" class="form-control">
                                    @foreach ($courses as $course)
                                    <option {{ (old('course') == $course->id) ? "selected" : "" }}value="{{ $course->id }}">{{ $course->course_code . ' - ' . $course->course_name }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <label>Student mobile number : </label>
                                <input type="text" value="{{ old('mobile_number') }}" class="form-control" placeholder="+639193693499" name="mobile_number">
                                <br>
                                <label>Gender : </label>
                                <select name="gender" class="form-control">
                                    <option {{ (old('gender') == 'male') ? "selected" : "" }} value="male">Male</option>
                                    <option {{ (old('gender') == 'female') ? "selected" : "" }} value="female">Female</option>
                                </select>
                                <br>
                                <label>Address : </label>
                                <textarea placeholder="Brgy. Awasian Tandag City" name="address" class="form-control" cols="30"  rows="10">{{ old('address') }}</textarea>
                                <hr>
                                <p>Parent's Information</p>
                                <label>Mother's name : </label>
                                <br>
                                <input type="text"  value="{{ old('mothersname') }}" placeholder="Cecil Nunez" class="form-control" name="mothersname">
                                <label>Father's name : </label>
                                <input type="text" placeholder="Gabby Nunez"  value="{{ old('fathersname') }}" class="form-control" name="fathersname">
                                <br>
                                <label>Mobile number of your parent's <small>(in case of emergency) : </small></label>
                                <input placeholder="+639193693284" value="{{ old('parent_mobile') }}" type="text" class="form-control" name="parent_mobile">
                                <br>
                                <div class="form-group float-right">
                                    <input type="submit" class="btn btn-primary rounded-0" value="Add student">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

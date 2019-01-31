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
                    @include('errors.error')
                    @include('success.success-message')
                <div class="row">
                    <div class="container">
                           <h4 class="text-uppercase ml-2">Send grade of student to parent</h4>
                           <hr>
                            <form method="POST">
                            @csrf
                            <label for="parentMobile">Parent mobile no.</label>
                            <input type="text" class="font-weight-bold form-control {{($student->parent_mobile_number ? : 'is-invalid')}}" name="parent_mobile_number"   value="{{($student->parent_mobile_number ? $student->parent_mobile_number : null)}}" readonly required="">
 <label>Grades : </label>
            <textarea readonly name="grades" class="form-control font-weight-bold text-justify" readonly rows="15">
                            @foreach ($grades as $key => $grade)
                  @php
                   $count     = 0;
                   $gpa       = 0;
                   $semestral = 0;
                   $gpa       = array_sum((array_column($grades[$key],'remarks')));
                   $count     = count(array_column($grades[$key],'subject_id'));
                   $semestral = $gpa / $count;
                  @endphp

------------------------------------------------------------
{{str_replace('_',' ',$key)}}       Semestral GPA : {{ number_format($semestral,1,'.',',')}}
@php $total_units = 0; @endphp
@foreach ($grade as $grade_sub)

{{$grade_sub->subject->sub}} - {{$grade_sub->subject->sub_description}} - {{(@$grade_sub->remarks) ? $grade_sub->remarks : 'NG'}} - Units : {{@$grade_sub->subject->units}}
@php $total_units += @$grade_sub->subject->units;@endphp
@endforeach
Total Credited Units : {{@$total_units}}
------------------------------------------------------------
@endforeach
</textarea>
<br>
                            <input type="submit" class="float-right btn btn-primary" value="Send to parent">
                            <br>
                            <br>
                           </form>
                </div>
            </div>
        @endsection

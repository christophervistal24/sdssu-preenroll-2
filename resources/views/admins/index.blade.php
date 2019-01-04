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
            <div class="main-content-container container-fluid px-4 card border-0 rounded-0">
                <!-- Page Header -->
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-2 offset-10 text-sm-left mb-0 float-right">
                    <label>Current semester</label>
                    <select id="semester"  class="form-control">
                        @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}"
                            {{ ($semester->current == 1 ) ? 'selected' : '' }}
                            >
                            {{ $semester->semester }}
                        </option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <!-- End Page Header -->
                <!-- Small Stats Blocks -->
                <div class="row">
                  <div class="col-lg col-md-6 col-sm-6 mb-4">
                      <div class="stats-small stats-small--1 card card-small rounded-0">
                          <div class="card-body p-0 d-flex">
                              <div class="d-flex flex-column m-auto">
                                  <div class="stats-small__data text-center">
                                      <span class="stats-small__label text-uppercase">CE STUDENTS</span>
                                      <h6 class="stats-small__value count my-3">{{$ce_students}}</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg col-md-6 col-sm-6 mb-4">
                      <div class="stats-small stats-small--1 card card-small rounded-0">
                          <div class="card-body p-0 d-flex">
                              <div class="d-flex flex-column m-auto">
                                  <div class="stats-small__data text-center">
                                      <span class="stats-small__label text-uppercase">CS STUDENTS</span>
                                      <h6 class="stats-small__value count my-3">{{$cs_students}}</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg col-md-4 col-sm-6 mb-4">
                      <div class="stats-small stats-small--1 card card-small rounded-0">
                          <div class="card-body p-0 d-flex">
                              <div class="d-flex flex-column m-auto">
                                  <div class="stats-small__data text-center">
                                      <span class="stats-small__label text-uppercase">INSTRUCTORS</span>
                                      <h6 class="stats-small__value count my-3">{{$instructors}}</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg col-md-4 col-sm-6 mb-4">
                      <div class="stats-small stats-small--1 card card-small rounded-0">
                          <div class="card-body p-0 d-flex">
                              <div class="d-flex flex-column m-auto">
                                  <div class="stats-small__data text-center">
                                      <span class="stats-small__label text-uppercase">BLOCKS</span>
                                      <h6 class="stats-small__value count my-3">{{$blocks}}</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg col-md-4 col-sm-12 mb-4">
                      <div class="stats-small stats-small--1 card card-small rounded-0">
                          <div class="card-body p-0 d-flex">
                              <div class="d-flex flex-column m-auto">
                                  <div class="stats-small__data text-center">
                                      <span class="stats-small__label text-uppercase">schedules</span>
                                      <h6 class="stats-small__value count my-3">{{$schedules}}</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
        @endsection

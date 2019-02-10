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
             @include('errors.error')
             @include('success.success-message')
            <div class="main-content-container container-fluid px-4 card border-0 rounded-0">
              <br>
    <!-- Default Light Table -->
            <div class="row">
              <div class="col-lg-4">
                <div class="card card-small mb-4 pt-3 rounded-0">
                  <div class="card-header border-bottom text-center">
                    <div class="mb-3 mx-auto">
                      <img class="rounded-circle" src="{{url("storage/profile/$user_info->profile") }}" alt="User Avatar" width="110">
                    </div>
                       <div>
                       <form action="/assistantdean/{{$user_info->id_number}}/changeprofile" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="hand-cursor">
                          <input type="file" name="profile"  />
                         </label>
                         <input type="submit" value="Change" class="btn btn-default">
                       </form>
                     </div>
                    <h4 class="mb-0 text-capitalize">{{$user_info->name}}</h4>
                    <span class="text-muted d-block mb-2">Assistant Dean</span>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-4">
                      <span>
                        <form action="/assistantdean/profile/{{$user_info->id_number}}" method="POST">
                          @csrf
                              <div class="form-group col-md-12">
                                <label for="fePassword">Old password</label>
                                <input name="old_password" type="password" class="form-control font-weight-bold" id="fePassword" placeholder="Old password">
                              </div>
                              <div class="form-group col-md-12">
                                <label for="newPassword">New Password</label>
                                <input type="password" name="new_password" class="form-control font-weight-bold" id="newPassword" placeholder="New Password">
                              </div>
                              <div class="form-group col-md-12">
                                <label for="reTypeNewPassword">Re-type new password</label>
                                <input type="password" class="form-control font-weight-bold" name="new_password_confirmation" id="reTypeNewPassword" placeholder="Re-type new password">
                              </div>
                              <input type="submit" value="Update password" class="btn btn-primary float-right">
                        </form>
                      </span>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-8 rounded-0">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom rounded-0">
                    <h6 class="m-0">Account Details</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col">
                          <form method="POST" action="/assistantdean/profile/{{$user_info->id_number}}">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <label for="feFirstName">Full Name</label>
                                <input type="text" class="form-control text-capitalize font-weight-bold" id="feFirstName" name="fullname" placeholder="First Name" value="{{$user_info->name}}">
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <label for="feEmailAddress">Education Qualification</label>
                                <input type="text"  name="education_qualification" class="font-weight-bold text-uppercase form-control" id="feEmailAddress" placeholder="Education qualification" value="{{$user_info->education_qualification}}">
                              </div>

                            </div>
                            <div class="form-group">
                              <label for="feInputAddress">Mobile Number</label>
                              <input type="text" class="font-weight-bold form-control" id="feInputAddress" name="mobile_number" value="{{$user_info->mobile_number}}">
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <label for="feInputCity">Status</label>
                                <select name="status" id="feInputCity" class="form-control font-weight-bold">
                                  <option value="1" {{($user_info->active  == 1) ? 'selected' : null }}>Active</option>
                                  <option value="0" {{($user_info->active  == 0) ? 'selected' : null }}>In-active</option>
                                </select>
                              </div>
                            </div>
                            <button type="submit" class="float-right btn btn-accent">Update Account</button>
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- End Default Light Table -->
            </div>
        </div>
        @endsection

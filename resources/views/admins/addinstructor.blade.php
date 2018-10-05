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
            <div class="main-content-container container-fluid px-4">
                <!-- Page Header -->
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                        <span class="text-uppercase page-subtitle">Dashboard</span>
                    </div>
                </div>
                <!-- End Page Header -->
                <!-- Small Stats Blocks -->
                <div class="row">
                    <div class="container-fluid">
                        @include('errors.error')
                        @include('success.success-message')
                        <form autocomplete="off" action="{{ url('/admin/addinstructor') }}" method="POST">
                            @csrf
                            <div class="form">
                                {{-- INSTRUCTOR FULLNAME --}}
                                <div class="form-group col-md-6 offset-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"    placeholder="Instructor Fullname"  required />
                                </div>

                                {{-- ID NUMBER --}}
                                <div class="form-group col-md-6 offset-3">
                                    <label>ID Number</label>
                                    <input type="text" name="id_number" class="form-control" value="{{ old('id_number') }}"   placeholder="Instructor ID Number"  required />
                                </div>

                                {{-- PASSWORD --}}
                                <div class="form-group col-md-6 offset-3">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password"  placeholder="Your password" required />
                                </div>

                                {{-- EDUCATION QUALIFICATION --}}
                                  <div class="form-group col-md-6 offset-3">
                                    <label>Education Qualification</label>
                                    <input type="text" class="form-control" value="{{ old('education_qualification') }}"   name="education_qualification"  placeholder="Education Qualification" required />
                                </div>

                                {{-- MAJOR --}}
                                <div class="form-group col-md-6 offset-3">
                                    <label>Major</label>
                                    <input type="text" class="form-control" value="{{ old('major') }}" name="major"  placeholder="Instructor Major" required />
                                </div>

                                {{-- POSITION --}}
                                <div class="form-group col-md-6 offset-3">
                                    <label>Position</label>
                                    <input type="text" class="form-control" value="{{ old('position') }}" name="position"  placeholder="Position" required />
                                </div>

                                {{-- STATUS --}}
                                <div class="form-group col-md-6 offset-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="permanent">Permanent</option>
                                        <option value="contractual">Contractual</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6 offset-3">
                                    <div class="text-right"><button class="btn btn-primary" type="submit">Add Instructor</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection

@inject('course','App\Course')
@extends('templates-dashboard.master')
@section('content')
<div class="main-navbar sticky-top bg-white">
    <!-- Main Navbar -->
    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
        <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
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
                    <h4 class="text-muted ml-2">List of all Instructors</h4>
                    <div class="container">
                        <table id="tables" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">ID Number</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Mobile #</th>
                                    <th class="text-center">Year</th>
                                    <th class="text-center">Course</th>
                                    <th class="text-center">Mother's name</th>
                                    <th class="text-center">Father's name</th>
                                    <th class="text-center">Parent mobile #</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr>
                                    <td class="text-center">{{ $student->id_number }}</td>
                                    <td>{{ ucwords($student->fullname) }}</td>
                                    <td>{{ $student->mobile_number }}</td>
                                    <td class="text-center">{{ digitToYearLevel($student->year) }}</td>
                                    <td class="text-center">BS{{ $student->course->course_code}}</td>
                                    <td class="text-center">{{ $student->parents->mothername }}</td>
                                    <td class="text-center text-truncate">{{ $student->parents->fathername }}</td>
                                    <td class="text-center">{{ $student->parents->mobile_number }}</td>
                                    <td class="text-center"><a href="/admin/student/{{ $student->id_number }}" class="text-white btn btn-success border-0 rounded-0"><b>Evaluate grades</b></a>
                                        </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
            {{-- MODAL START --}}
            <!-- Modal -->
            <div class="modal fade" id="editInstructor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Instructor Info.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" onsubmit="event.preventDefault(); submitInstructorInfo()" autocomplete="off">
                                <div class="form">
                                    @csrf
                                    {{-- INSTRUCTOR FULLNAME --}}
                                    <input type="hidden" id="instructorId" class="form-control" value="{{ old('name') }}"  required />
                                    <div class="form-group col-md-12">
                                        <label>Fullname</label>
                                        <input type="text" id="instructorFullname" class="form-control" value="{{ old('name') }}"    placeholder="Instructor Fullname"  required />
                                    </div>
                                    {{-- ID NUMBER --}}
                                    <div class="form-group col-md-12">
                                        <label>ID Number</label>
                                        <input type="text" id="instructorIdNumber" name="id_number" class="form-control" value="{{ old('id_number') }}"   placeholder="Instructor ID Number"  required />
                                    </div>
                                    {{-- PASSWORD --}}
                                    {{-- <div class="form-group col-md-12">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password"  placeholder="Your password" required />
                                    </div> --}}
                                    {{-- EDUCATION QUALIFICATION --}}
                                    <div class="form-group col-md-12">
                                        <label>Education Qualification</label>
                                        <input type="text" id="instructorEducationQual" class="form-control" value="{{ old('education_qualification') }}"   name="education_qualification"  placeholder="Education Qualification" required />
                                    </div>
                                    {{-- MAJOR --}}
                                    {{-- <div class="form-group col-md-12">
                                        <label>Major</label>
                                        <input type="text" class="form-control" value="{{ old('major') }}" name="major"  placeholder="Instructor Major" required />
                                    </div> --}}
                                    {{-- POSITION --}}
                                    <div class="form-group col-md-12">
                                        <label>Position</label>
                                        <input type="text" id="instructorPosition" class="form-control" value="{{ old('position') }}" name="position"  placeholder="Position" required />
                                    </div>
                                    {{-- STATUS --}}
                                    <div class="form-group col-md-12">
                                        <label>Status</label>
                                        <select name="status" id="instructorStatus" class="form-control">
                                            <option value="permanent">Permanent</option>
                                            <option value="contractual">Contractual</option>
                                        </select>
                                    </div>
                                    {{-- MOBILE --}}
                                    <div class="form-group col-md-12">
                                        <label>Mobile Number</label>
                                        <input type="text" name="mobile_number" id="mobileNumber" class="form-control" placeholder="+639127961717">
                                    </div>
                                    {{-- ACTIVE --}}
                                    <div class="form-group col-md-12">
                                        <label>Active</label>
                                        <select name="active" id="instructorIsActive" class="form-control">
                                            <option value="Active">Active</option>
                                            <option value="In Active">In Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="editInstructorSave">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- MODAL END --}}
            @endsection

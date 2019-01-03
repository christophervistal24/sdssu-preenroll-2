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
            <div class="main-content-container  px-4 card" style="border-radius: 0px">
                <!-- Page Header -->
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                        <span class="text-uppercase page-subtitle">Dashboard</span>
                    </div>
                </div>
                <!-- End Page Header -->
                <!-- Small Stats Blocks -->
                <div class="row">
                    <div class="col-md-6">
                        <h4>List of all Students</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="/admin/import/students" class="btn btn-primary border-0 p-2">Import students</a>
                    </div>
                </div>
                        <table id="student-table" class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th class="text-center">ID Number</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Mobile #</th>
                                    <th class="text-center">Year</th>
                                    <th class="text-center">Course</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr>
                                    <th class="text-center">{{ hyphenate($student->id_number) }}</th>
                                    <td>{{ ucwords($student->fullname) }}</td>
                                    <td class="text-center">{{ ucwords($student->gender) }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td>{{ $student->mobile_number }}</td>
                                    <td class="text-center">{{ digitToYearLevel($student->year) }}</td>
                                    <td class="text-center">BS{{ $student->course->course_code }}</td>

                                    <td class="text-center">
                                  <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       Actions
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a id="btnEditInfo" params="{{json_encode([
                                        'id_number'     => $student->id_number,
                                        'fullname'      => $student->fullname,
                                        'gender'      => $student->gender,
                                        'address'       => $student->address,
                                        'mobile'        => $student->mobile_number,
                                        'year'          => $student->year,
                                        'course'        => $student->course->id,
                                        'mothers_name'  => $student->mothername,
                                        'fathers_name'  => $student->fathername,
                                        'parent_mobile' => $student->parent_mobile_number,
                                    ])}}" class="p-2 text-center text-black dropdown-item" style="cursor:pointer;"><b>EDIT INFO</b></a>
                                    <a href="/admin/student/{{ $student->id_number }}" class=" dropdown-item p-2 text-center text-gray"><b>EVALUATE</b></a>
                                      <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-center" data-target="parents" id="btnEditInfo" params="{{json_encode([
                                        'id_number'     => $student->id_number,
                                        'fullname'      => $student->fullname,
                                        'gender'      => $student->gender,
                                        'address'       => $student->address,
                                        'mobile'        => $student->mobile_number,
                                        'year'          => $student->year,
                                        'course'        => $student->course->id,
                                        'mothers_name'  => $student->mothername,
                                        'fathers_name'  => $student->fathername,
                                        'parent_mobile' => $student->parent_mobile_number,
                                    ])}}" style="cursor:pointer;"><b>VIEW PARENTS</b></a>
                                        <a href="" class="dropdown-item text-center"><b>SEND SCHEDULE <br> TO PARENTS</b></a>
                                        <a href="" class="dropdown-item text-center"><b>SEND GRADES <br> TO PARENTS</b></a>
                                      </div>
                                      </div>
                                    </div>
                                   </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
            </div>
            {{-- MODAL START --}}
            <!-- Modal -->
            <div class="modal fade" id="editStudentInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Student Info.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editStudentForm" autocomplete="off">
                                <div class="form">
                                    <div class="form-group col-md-12" id="studentFullnameContainer">
                                        <label>Fullname</label>
                                        <input type="text" name="fullname" id="studentFullname" class="form-control"  required />
                                    </div>

                                    <div class="form-group col-md-12" id="studentIdNumberContainer">
                                        <label>ID Number</label>
                                        <input type="text" name="id_number"  id="studentIdNumber"  class="form-control"  required />
                                    </div>

                                    <div class="form-group col-md-12" id="studentGenderContainer">
                                        <select name="student_gender" class="form-control" id="studentGender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12" id="studentAddressContainer">
                                        <textarea class="form-control"  name="student_address" id="studentAddress" cols="30" rows="5"></textarea>
                                    </div>




                                    <div class="form-group col-md-12" id="studentMobileNumberContainer">
                                        <label>Mobile Number : </label>
                                        <input type="text" name="student_mobile"  id="studentMobileNumber" class="form-control"   required />
                                    </div>

                                    <div class="form-group col-md-12" id="studentYearContainer">
                                        <label>Year : </label>
                                        <select name="student_year" class="form-control" id="studentYear">
                                            @foreach (range(1,5) as $year)
                                                <option value="{{$year}}" id="studentYear">{{$year}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12" id="studentCourseContainer">
                                        <label>Course : </label>
                                        <select name="student_course" id="studentCourse" class="form-control">
                                            <option value="2">CS</option>
                                            <option value="1">CE</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                         <div class="form-group col-md-6">
                                            <label>Father's name : </label>
                                            <input name="student_father" type="text" id="studentFathersname" class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Mother's name : </label>
                                            <input type="text" name="student_mother" id="studentMothersname" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Parent Mobile number : </label>
                                        <input  name="parent_mobile" class="form-control" type="text" id="parentMobileNumber">
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

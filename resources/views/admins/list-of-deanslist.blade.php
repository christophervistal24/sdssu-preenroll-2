@inject('course','App\Course')
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
            <div class="main-content-container container-fluid px-4 card" style="border-radius: 0px">
                <!-- Page Header -->
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                        <span class="text-uppercase page-subtitle">List of Deans lister</span>
                    </div>
                </div>
                <!-- End Page Header -->
                <!-- Small Stats Blocks -->
                <div class="row">
                    <h4 class="text-muted ml-2"></h4>
                    <div class="container-fluid">
                        <table id="student-table" class="table table-bordered" style="width :100%;">
                            <thead>
                                <th>ID No.</th>
                                <th>Fullname</th>
                                <th>Address</th>
                                <th class="text-center">Gender</th>
                                <th class="text-center">Year</th>
                                <th class="text-center">Course</th>
                                <th class="text-center">Mobile No.</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                                @foreach ($list as $list_info)
                                    <tr>
                                        <td class="text-center"> {{hyphenate($list_info->student->id_number)}}</td>
                                        <td>{{$list_info->student->fullname}}</td>
                                        <td class="text-center">{{$list_info->student->address}}</td>
                                        <td class="text-capitalize text-center">{{$list_info->student->gender}}</td>
                                        <td class="text-center">{{digitToYearLevel($list_info->student->year)}}</td>
                                        <td class="text-center">BS{{$list_info->student->course->course_code}}</td>
                                        <td >{{$list_info->student->mobile_number}}</td>
                                        <td class="text-center"><a href="/admin/student/{{$list_info->student->id_number}}" class="text-white rounded-0 btn btn-success"><span class="font-weight-bold text-capitalize">VIEW GRADES</span></a>
                                        <a href="/admin/send/to/student/{{$list_info->student->id_number}}" class="btn btn-primary border-0 rounded-0 font-weight-bold">SEND SMS</a></td>
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
                                    <div class="form-group col-md-12">
                                        <label>Fullname</label>
                                        <input type="text" name="fullname" id="studentFullname" class="form-control"  required />
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>ID Number</label>
                                        <input type="text" name="id_number"  id="studentIdNumber"  class="form-control"  required />
                                    </div>

                                    <div class="form-group col-md-12">
                                        <select name="student_gender" class="form-control" id="studentGender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <textarea class="form-control"  name="student_address" id="studentAddress" cols="30" rows="5"></textarea>
                                    </div>




                                    <div class="form-group col-md-12">
                                        <label>Mobile Number : </label>
                                        <input type="text" name="student_mobile"  id="studentMobileNumber" class="form-control"   required />
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Year : </label>
                                        <select name="student_year" class="form-control" id="studentYear">
                                            @foreach (range(1,5) as $year)
                                                <option value="{{$year}}" id="studentYear">{{$year}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
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

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
                    <h4 class="text-muted ml-2">List of all Subjects</h4>
                    <div class="container">
                        <button class="btn btn-primary mb-2 rounded-0" id="addSubject">Add new subject</button>
                        <table id="subjectTable" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Subjects</th>
                                    <th class="text-center">Subjects Desc.</th>
                                    <th class="text-center">Units</th>
                                    <th class="text-center">Pre-requisite</th>
                                    <th class="text-center">Course</th>
                                    <th class="text-center">Year</th>
                                    <th class="text-center">Semester</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_of_subjects as $subject)
                                <tr>
                                    <td>{{ $subject->sub }}</td>
                                    <td>{{ $subject->sub_description }}</td>
                                    <td class="text-center">{{ $subject->units }}</td>
                                    <td class="text-center font-weight-bold">{{ $subject->subject_pre_requisites }}</td>
                                    <td class="text-center"> {{ ($subject->course == 1) ?  'CE' : 'CS' }}</td>
                                    <td class="text-center">{{ digitToYearLevel($subject->year) }}</td>
                                    <td>{{ ($subject->semester == 1) ? 'First sem.' : 'Second sem.' }}</td>
                                    <td class="text-success text-center">
                                        <button id="displayEditModal" params="{{json_encode(
                                        [
                                        'subject_id'          => $subject->id,
                                        'subject_sub'         => $subject->sub,
                                        'subject_course'      => $subject->course,
                                        'subject_description' => $subject->sub_description,
                                        'subject_units'       => $subject->units,
                                        'subject_prereq'      => $subject->subject_pre_requisites,
                                        'subject_year'        => $subject->year,
                                        'subject_semester'    => $subject->semester,
                                        ]
                                        )
                                        }}" class="text-white btn btn-success rounded-0"
                                        ><i class="material-icons">edit</i> <b>EDIT</b></button>
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
            <div class="modal fade" id="subjectModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="subjectTitle">Edit Subject.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form  id="subjectForm" autocomplete="off">
                                <div class="form">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label>Subject Code : </label>
                                        <input type="text" id="subjectCode" class="form-control" name="subject" placeholder="Subject">
                                    </div>
                                    <div class="form-group">
                                        <label>Subject Desc.</label>
                                        <input type="text" id="subjectDesc" class="form-control" name="subject_description" placeholder="Subject Description">
                                    </div>
                                    <div class="form-group">
                                        <label>Units</label>
                                        <input type="number" id="subjectUnits" class="form-control" name="units" placeholder="Units">
                                    </div>
                                    <div class="form-group">
                                        <label>Year : </label>
                                        <select class="form-control" id="subjectYear" name="year">
                                            <option value="1">First year</option>
                                            <option value="2">Second year</option>
                                            <option value="3">Third year</option>
                                            <option value="4">Fourth year</option>
                                            <option value="5">Fifth year</option>
                                        </select>
                                    </div>
                                    <label>Course : </label>
                                     <div class="form-group row">
                                        <select   title="Course for subject..." class="form-control show-menu-arrow"  id="course" name="course">
                                            @foreach ($courses as $course)
                                               <option value="{{ $course->id }}">{{ $course->course_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label>Pre requisite : <span class="text-warning">Optional and to remove an item select it again</span> </label>
                                    <div class="form-group row">
                                        <select  data-live-search="true" title="Choose one of the following..." class="selectpicker form-control show-menu-arrow" id="subjectPre" name="pre_req[]" multiple>
                                            <option value="4th year Standing">4th year Standing</option>
                                            <option value="3rd year Standing">3rd year Standing</option>
                                            @foreach ($list_of_subjects as $subject)
                                            <option value="{{ ($subject->sub != null) ? $subject->sub : "" }}">{{ ($subject->sub != "") ? $subject->sub : "" }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Semester : </label>
                                        <select class="form-control" id="subjectSemester" name="semester">
                                            <option value="1">First sem.</option>
                                            <option value="2">Second sem.</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" id="action" value="add">
                                <div class="modal-footer">
                                    {{-- <button type="reset" class="btn btn-default">Reset</button> --}}
                                    <button type="submit" class="btn btn-primary" id="btnSave">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- MODAL END --}}
                @endsection

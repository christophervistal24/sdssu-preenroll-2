@inject('studentSubject','App\StudentSubject')
@inject('inject_subject','App\Subject')
@inject('course','App\Course')
@inject('student_grade','App\StudentGrade')
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
								<span class="d-none d-md-inline-block">{{ ucwords($user_info->name) }}</span>
							</a>
							<div class="dropdown-menu dropdown-menu-small">
								<a class="dropdown-item" href="user-profile-lite.html">
								<i class="material-icons">&#xE7FD;</i> Profile</a>
								<a class="dropdown-item" href="components-blog-posts.html">
								<i class="material-icons">vertical_split</i> Blog Posts</a>
								<a class="dropdown-item" href="add-new-post.html">
								<i class="material-icons">note_add</i> Add New Post</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item text-danger" href="{{ url('/instructor/logout') }}">
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
						<span class="text-uppercase page-subtitle">Dashboard</span>
					</div>
				</div>
				<h4 class="text-muted">List of your students in <b> {{ $subject->subject  }}</b></h4>
				@php
					$date = $student_grade->where('subject_id',$subject->id)->orderBy('expiration','ASC')->first();
				@endphp
				@if ($date)

					@php
					$now = \Carbon\Carbon::now();
					$expire_in = \Carbon\Carbon::parse($date->expiration);
					@endphp
					@if (@$now >= @$expire_in)

						<div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
							<span class="text-white">{{ 'Your modification power is expired you already reach the 45 days' }}</span>
						</div>
						<br>
						@else
						<div class="alert alert-success alert-dismissible fade show text-white" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
							<span>You can modify student grades until 	{{ $date->expiration->format('jS \o\f F, Y g:i A') }}</span>
						</div>
					@endif
				@endif
				@include('success.success-message')
				<table id="tables" class="table table-bordered" style="width:100%">
					<thead class="text-center">
						<th>Student ID no.</th>
						<th>Student Fullname</th>
						<th>Course</th>
						<th>Block</th>
						<th>Remarks</th>
						@if (@$now >= @$expire_in)
						@else
						<th>Actions</th>
						@endif
					</thead>
					<tbody>
						@foreach ($students_infos as $student)
							<tr>
								<td class="text-black">{{ substr_replace($student->id_number, '-', 2, 0) }}</td>
								<td class="text-black">{{ $student->fullname }}</td>
								<td class="text-black text-center">{{
											 $course->getCourse($student->course_id)
															->course_code
														}}</td>
								<td class="text-black text-center">{{ $student->block }}</td>
								<td class="text-black text-center">



									@if (in_array($student->id,$students_with_grades))
											{{
												$grade = $student_grade->getStudentGrades([
													'student_id' => $student->id,
													'subject_id' => $subject->id
												])
											 }}
									@endif
								@if (@$now >= @$expire_in)
						@else
								</td>
								<td class="text-center">
									@if (!in_array($student->id,$students_with_grades))
									<button id="btnModal" onclick="displayModalForGrade(
											 ({{  json_encode(
                                    [
											'id'        => $student->id,
											'id_number' => $student->id_number,
											'fullname'  => $student->fullname,
											'block'		=> $student->block,
											'year'		=> $student->year,
											'subject'	=> $subject->id

                                     ]
                                        )
                                        }})
									)" class="btn btn-primary rounded-0 border-0" ><i class="material-icons">add</i> Add grade</button>
									@else
									<button id="btnModal" onclick="displayModalForGrade(
											 ({{  json_encode(
                                    [
											'id'        => $student->id,
											'id_number' => $student->id_number,
											'fullname'  => $student->fullname,
											'block'     => $student->block,
											'year'      => $student->year,
											'subject'   => $subject->id,
											'grade'     => $grade

                                     ]
                                        )
                                        }})
									)" class="btn btn-success rounded-0 border-0" ><i class="material-icons">edit</i><b> Edit grade</b></button>
									@endif
					@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		  {{-- MODAL START --}}
            <!-- Modal -->
            <div class="modal fade" id="modalAddGrade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Add grade for.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="remarksForm" onsubmit="event.preventDefault(); addGrade();">
                                <div class="form">
                                    @csrf
                                    {{-- MOBILE --}}
                                    <div class="form-group col-md-12">
                                        <label>Remarks :</label>
                                        <div id="modalBody">
                                            <input type="text" required id="studentGrade"  class="form-control" placeholder="Input grade">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="modalBtnSave">Save & Send</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- MODAL END --}}
		@endsection

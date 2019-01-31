@inject('student_model','App\Student')
@extends('templates-dashboard.master')
@section('content')
   <div class="main-navbar sticky-top bg-white">
        <!-- Main Navbar -->
        <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
            <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
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
                                    <img class="user-avatar rounded-circle mr-2"  src="{{url("storage/profile/$user_info->profile")}}" alt="User Avatar">
                                    <span class="d-none d-md-inline-block text-capitalize">{{ $user_info->name }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-small">
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
				{{-- ADD 45 DAYS  --}}
				<h4 class="text-muted"><span class="font-weight-bold">{{  $subject->sub . ' ' . $subject->sub_description }}</span></h4>
				@if (isset($expiration) && $startToGrade)
					<div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						<span class="text-white">{{ 'Your modification power is expired you already reach the 45 days' }}</span>
					</div>
				@elseif($startToGrade)
					<div class="alert alert-success alert-dismissible fade show text-white" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						<span class="text-white">{{ 'You can modify some student grades within 45 days' }}</span>
					</div>
				@endif
				<br>
				@include('success.success-message')
				<table id="tables" class="table table-bordered" style="width:100%">
					<thead class="text-center">
						<th>Student ID no.</th>
						<th>Student Fullname</th>
						<th>Course</th>
						<th>Remarks</th>
						<th>Actions</th>
					</thead>
					<tbody>
						@foreach ($sched_students->students as $student)
						<tr>
							<td class="text-center font-weight-bold">
								{{ hyphenate($student->id_number) }}
							</td>
							<td class="text-center font-weight-bold">{{ $student->fullname }}</td>
							<td class="text-center">{{ $student->course->course_code }}</td>
							<td class="text-center">
								@php
								//check if the student has a grade
								//note:refactor this code

								$check_grade = $student_model->find($student->id_number)
															->grades
															->where('subject_id',$sched_students->subject->id)
															->first();
								@endphp
								 @if (isset($check_grade->remarks))
								{{ $check_grade->remarks }}
									@if (!isset($expiration))
										<td class="text-center"><button type="button" id="btnEditGrade" class="btn btn-success" params="{{ json_encode([
											'subject_id'        =>  $sched_students->subject->id ,
											'fullname'          => $student->fullname,
											'remarks'           => $check_grade->remarks,
											'student_id_number' =>  $student->id_number ,
											'grade_id'			=> $check_grade->id
										]) }}"> Edit grade</button></td>
										@else
										<td></td>
									@endif
								@else
									@if (!isset($expiration))
										<td class="text-center"><button type="button" id="btnAddGrade" class="btn btn-primary" params="{{ json_encode([
											'subject_id'        =>  $sched_students->subject->id ,
											'fullname'          => $student->fullname,
											'student_id_number' =>  $student->id_number,
											'grade_id'          => $check_grade->id,
											'schedule_id'       => $sched_students->id,
										]) }}"> Add grade</button></td>
										@else
										<td></td>
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
						<form id="remarksForm" autocomplete="off">
							<div class="form">
								@csrf
								<div class="form-group col-md-12">
									<label>Remarks :</label>
									<div id="modalBody">
										<input type="hidden" name="action" value="add" id="action">
										<input type="text" name="grade" required id="studentGrade"  class="form-control" placeholder="Input grade">
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

@inject('instructor','App\Instructor')
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
					</div>
				</div>
				<!-- End Page Header -->
				<div class="row">
					<div class="col-md-6 offset-1">
						<p>Name : <span class="font-weight-bold">{{ ucwords($user_info->name) }}</span></p>
						<p>Years in service : <span class="font-weight-bold">{{ ucwords($user_info->created_at->diff(\Carbon\Carbon::now())
         ->format('%y years, %m months and %d days')) }}</span></p>
						<p>Status : <span class="font-weight-bold">{{ ucwords($user_info->status) }}</span></p>
					</div>
					<div class="col-md-4">
						<p class="">Educ. Qualifaction : <span class="font-weight-bold"> {{ strtoupper($user_info->education_qualification) }}</span></p>
						<p class="">Major : <span class="font-weight-bold">{{ ucwords($user_info->major) }}</span></p>
					</div>
				</div>
				<div class="fixed-bottom mb-5">
					<a href="/instructor/schedule/print/0" class="btn btn-secondary float-right">PRINT</a>
				</div>
				<table id="sched-table" class="table table-bordered" style="width:100%">
					<thead class="text-center">
						<th scope="col">Time & Day</th>
						<th>Course No.</th>
						<th>Description</th>
						<th>Course Year</th>
						<th>No. of Students</th>
						<th>Units</th>
						<th>Room</th>
						<th>Action</th>
					</thead>
					<tbody class="text-center">
						@php
						$sum = 0;
						@endphp
						@foreach ($instructors as $schedule)
							@if ($loop->first)
							<td colspan="8"  class="text-left"><span class="font-weight-bold ml-5" >MWF</span></td>
							@endif
						@foreach ($schedule->schedules as $instructor_sched)
						<tr>
							@if(strtolower($instructor_sched->days) === 'mwf' || strtolower($instructor_sched->days) === 'mwf')
							<td>{{  $instructor_sched->start_time . ' - ' . $instructor_sched->end_time }}</td>
							<td>{{ $instructor_sched->subject->sub }}</td>
							<td class="text-left">{{ $instructor_sched->subject->sub_description }}</td>
							<td>
								{{ $instructor_sched->block_schedule->level . $instructor_sched->block_schedule->course . $instructor_sched->block_schedule->block_name
								}}
							</td>
							<td>{{ $no_of_students = $instructor->sched_student($instructor_sched->id) }}</td>
							@php $sum += $instructor_sched->subject->units; @endphp
							<td>{{ $instructor_sched->subject->units }}</td>
							<td>{{ $instructor_sched->room }}</td>
							<td><a href="/instructor/students/{{ $instructor_sched->id }}">View students</a></td>
							@endif
						</tr>
						@endforeach
						@if (isset($instructor_sched->days))
						<td colspan="8"  class="text-left"><span class="font-weight-bold  ml-5">TTH</span></td>
						@endif
						@foreach ($schedule->schedules as $instructor_sched)
						<tr>
							@if($instructor_sched->days === 'TTH')
							<td>{{  $instructor_sched->start_time . ' - ' . $instructor_sched->end_time }}</td>
							<td>{{  $instructor_sched->subject->sub }}</td>
							<td class="text-left">{{  $instructor_sched->subject->sub_description }}</td>
							<td>
								{{
								$instructor_sched->block_schedule->level .
								$instructor_sched->block_schedule->course .
								$instructor_sched->block_schedule->block_name
								}}
							</td>

								<td>{{ $instructor->sched_student($instructor_sched->id) }}</td>
							@php $sum += $instructor_sched->subject->units; @endphp
							<td>{{ $instructor_sched->subject->units }}</td>
							<td>{{ $instructor_sched->room }}</td>
							<td><a href="/instructor/students/{{ $instructor_sched->id }}">View students</a></td>
							@endif
						</tr>
						@endforeach
						@if (isset($instructor_sched->days))
						<td colspan="8"  class="text-left"><span class="font-weight-bold ml-5">S</span></td>
						@endif
						@foreach ($schedule->schedules as $instructor_sched)
						<tr>
							@if($instructor_sched->days === 'S')
							<td>{{  $instructor_sched->start_time . ' - ' . $instructor_sched->end_time }}</td>
							<td>{{ $instructor_sched->subject->sub }}</td>
							<td class="text-left">{{ $instructor_sched->subject->sub_description }}</td>
							<td>
								{{
								$instructor_sched->block_schedule->level .
								$instructor_sched->block_schedule->course .
								$instructor_sched->block_schedule->block_name
								}}
							</td>
							<td>{{ $instructor->sched_student($instructor_sched->id) }}</td>
							@php $sum += $instructor_sched->subject->units; @endphp
							<td>{{ $instructor_sched->subject->units }}</td>
							<td>{{ $instructor_sched->room }}</td>
							<td><a href="/instructor/students/{{ $instructor_sched->id }}">View students</a></td>
							@endif
						</tr>
						@endforeach
						@endforeach
						@if ($sum != 0)
						<tr>
							<th class="text-left">No. of Units</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th>{{ $sum }}</th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th class="text-left">No. of Preparation</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th class="text-left">Add Designation</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th class="text-left">Add special assignmnt</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th class="text-left">Total no. of Units</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
		@endsection

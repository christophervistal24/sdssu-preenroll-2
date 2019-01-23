@extends('templates-dashboard.master')
@section('content')
<div class="main-navbar sticky-top bg-white">
    <!-- Main Navbar -->
    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
            <p class="mt-3 ml-3">No. of schedules : {{ $no_of_schedule }}</p>
            <p class="mt-3">No. of assigned schedule : {{ $no_of_scheduled }}</p>
            <p class="mt-3">Unassigned schedule : {{ $no_of_schedule - $no_of_scheduled }}</p>
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
            <div class="main-content-container container-fluid px-4 card border-0 rounded-0">
                <!-- Page Header -->
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-2 offset-10 text-sm-left mb-0 float-right">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                          @include('success.student-success')
                        {{-- <table id="tables" class="table table-bordered">
                           <thead>
                                <tr>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Days</th>
                                    <th class="text-center">Room</th>
                                    <th class="text-center">Block</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Instructor</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    <tr>
                                        <td class="text-center">{{
                                            \Carbon\Carbon::parse($schedule->start_time)
                                            ->format('g:i A')  }}
                                             - {{
                                                \Carbon\Carbon::parse($schedule->end_time)->format('g:i A')
                                                }}</td>
                                        <td class="text-center">{{ $schedule->days }}</td>
                                        <td class="text-center">{{ $schedule->room }}</td>
                                        <td class="text-center">{{ $schedule->level . $schedule->course . $schedule->block_name }}</td>
                                        <td>
                                        {{ findCharacterPosWithDelimeter($schedule->subject,',') }}</td>
                                        <td class="text-center">{{ ucwords($schedule->instructor_name) }}</td>
                                        @if (isset($schedule->instructor_name))
                                            <td class="text-center"><a  href="/assistantdean/editassign/{{ $schedule->instructor_id_number }}/{{ $schedule->schedule_id }}" class="text-white btn btn-success">EDIT INSTRUCTOR</a></td>
                                        @else
                                        @php
                                            $schedule = explode(',',$schedule->schedule_id);
                                        @endphp
                                            <td class="text-center"><a href="/assistantdean/assign/{{$schedule[0] }}/{{ isset($schedule[1]) ? $schedule[1] : null }}" class="text-white btn btn-primary">ASSIGN INSTRUCTOR</a></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> --}}

                        {{-- FIRST YEAR SUBJECTS --}}
                    <h1>First year subjects</h1>
                        <table class="table table-bordered">
                           <thead>
                                <tr>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Days</th>
                                    <th class="text-center">Room</th>
                                    <th class="text-center">Block</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Instructor</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    @if($schedule->level == 1)
                                    <tr>
                                        <td class="text-center">{{
                                            \Carbon\Carbon::parse($schedule->start_time)
                                            ->format('g:i A')  }}
                                             - {{
                                                \Carbon\Carbon::parse($schedule->end_time)->format('g:i A')
                                                }}</td>
                                        <td class="text-center">{{ $schedule->days }}</td>
                                        <td class="text-center">{{ $schedule->room }}</td>
                                        <td class="text-center">{{ $schedule->level . $schedule->course . $schedule->block_name }}</td>
                                        <td>
                                        {{ findCharacterPosWithDelimeter($schedule->subject,',') }}</td>
                                        <td class="text-center">{{ ucwords($schedule->instructor_name) }}</td>
                                        @if (isset($schedule->instructor_name))
                                            <td class="text-center"><a  href="/assistantdean/editassign/{{ $schedule->instructor_id_number }}/{{ $schedule->schedule_id }}" class="text-white btn btn-success">EDIT INSTRUCTOR</a></td>
                                        @else
                                        @php
                                            $schedule = explode(',',$schedule->schedule_id);
                                        @endphp
                                            <td class="text-center"><a href="/assistantdean/assign/{{$schedule[0] }}/{{ isset($schedule[1]) ? $schedule[1] : null }}" class="text-white btn btn-primary">ASSIGN INSTRUCTOR</a></td>
                                        @endif
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <br>
                        <hr>
                        <h1>Second year Subjects</h1>
                        <table class="table table-bordered">
                           <thead>
                                <tr>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Days</th>
                                    <th class="text-center">Room</th>
                                    <th class="text-center">Block</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Instructor</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    @if($schedule->level == 2)
                                    <tr>
                                        <td class="text-center">{{
                                            \Carbon\Carbon::parse($schedule->start_time)
                                            ->format('g:i A')  }}
                                             - {{
                                                \Carbon\Carbon::parse($schedule->end_time)->format('g:i A')
                                                }}</td>
                                        <td class="text-center">{{ $schedule->days }}</td>
                                        <td class="text-center">{{ $schedule->room }}</td>
                                        <td class="text-center">{{ $schedule->level . $schedule->course . $schedule->block_name }}</td>
                                        <td>
                                        {{ findCharacterPosWithDelimeter($schedule->subject,',') }}</td>
                                        <td class="text-center">{{ ucwords($schedule->instructor_name) }}</td>
                                        @if (isset($schedule->instructor_name))
                                            <td class="text-center"><a  href="/assistantdean/editassign/{{ $schedule->instructor_id_number }}/{{ $schedule->schedule_id }}" class="text-white btn btn-success">EDIT INSTRUCTOR</a></td>
                                        @else
                                        @php
                                            $schedule = explode(',',$schedule->schedule_id);
                                        @endphp
                                            <td class="text-center"><a href="/assistantdean/assign/{{$schedule[0] }}/{{ isset($schedule[1]) ? $schedule[1] : null }}" class="text-white btn btn-primary">ASSIGN INSTRUCTOR</a></td>
                                        @endif
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                        <br>
                        <br>
                        <hr>
                        <h1>Third year Subjects</h1>
                        <table class="table table-bordered">
                           <thead>
                                <tr>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Days</th>
                                    <th class="text-center">Room</th>
                                    <th class="text-center">Block</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Instructor</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    @if($schedule->level == 3)
                                    <tr>
                                        <td class="text-center">{{
                                            \Carbon\Carbon::parse($schedule->start_time)
                                            ->format('g:i A')  }}
                                             - {{
                                                \Carbon\Carbon::parse($schedule->end_time)->format('g:i A')
                                                }}</td>
                                        <td class="text-center">{{ $schedule->days }}</td>
                                        <td class="text-center">{{ $schedule->room }}</td>
                                        <td class="text-center">{{ $schedule->level . $schedule->course . $schedule->block_name }}</td>
                                        <td>
                                        {{ findCharacterPosWithDelimeter($schedule->subject,',') }}</td>
                                        <td class="text-center">{{ ucwords($schedule->instructor_name) }}</td>
                                        @if (isset($schedule->instructor_name))
                                            <td class="text-center"><a  href="/assistantdean/editassign/{{ $schedule->instructor_id_number }}/{{ $schedule->schedule_id }}" class="text-white btn btn-success">EDIT INSTRUCTOR</a></td>
                                        @else
                                        @php
                                            $schedule = explode(',',$schedule->schedule_id);
                                        @endphp
                                            <td class="text-center"><a href="/assistantdean/assign/{{$schedule[0] }}/{{ isset($schedule[1]) ? $schedule[1] : null }}" class="text-white btn btn-primary">ASSIGN INSTRUCTOR</a></td>
                                        @endif
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                        <br>
                        <br>
                        <hr>
                        <h1>Fourth year Subjects</h1>
                        <table class="table table-bordered">
                           <thead>
                                <tr>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Days</th>
                                    <th class="text-center">Room</th>
                                    <th class="text-center">Block</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Instructor</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    @if($schedule->level == 4)
                                    <tr>
                                        <td class="text-center">{{
                                            \Carbon\Carbon::parse($schedule->start_time)
                                            ->format('g:i A')  }}
                                             - {{
                                                \Carbon\Carbon::parse($schedule->end_time)->format('g:i A')
                                                }}</td>
                                        <td class="text-center">{{ $schedule->days }}</td>
                                        <td class="text-center">{{ $schedule->room }}</td>
                                        <td class="text-center">{{ $schedule->level . $schedule->course . $schedule->block_name }}</td>
                                        <td>
                                        {{ findCharacterPosWithDelimeter($schedule->subject,',') }}</td>
                                        <td class="text-center">{{ ucwords($schedule->instructor_name) }}</td>
                                        @if (isset($schedule->instructor_name))
                                            <td class="text-center"><a  href="/assistantdean/editassign/{{ $schedule->instructor_id_number }}/{{ $schedule->schedule_id }}" class="text-white btn btn-success">EDIT INSTRUCTOR</a></td>
                                        @else
                                        @php
                                            $schedule = explode(',',$schedule->schedule_id);
                                        @endphp
                                            <td class="text-center"><a href="/assistantdean/assign/{{$schedule[0] }}/{{ isset($schedule[1]) ? $schedule[1] : null }}" class="text-white btn btn-primary">ASSIGN INSTRUCTOR</a></td>
                                        @endif
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                        <br>
                        <br>
                        <hr>
                        <h1>Fifth year Subjects</h1>
                        <table class="table table-bordered">
                           <thead>
                                <tr>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Days</th>
                                    <th class="text-center">Room</th>
                                    <th class="text-center">Block</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Instructor</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    @if($schedule->level == 5)
                                    <tr>
                                        <td class="text-center">{{
                                            \Carbon\Carbon::parse($schedule->start_time)
                                            ->format('g:i A')  }}
                                             - {{
                                                \Carbon\Carbon::parse($schedule->end_time)->format('g:i A')
                                                }}</td>
                                        <td class="text-center">{{ $schedule->days }}</td>
                                        <td class="text-center">{{ $schedule->room }}</td>
                                        <td class="text-center">{{ $schedule->level . $schedule->course . $schedule->block_name }}</td>
                                        <td>
                                        {{ findCharacterPosWithDelimeter($schedule->subject,',') }}</td>
                                        <td class="text-center">{{ ucwords($schedule->instructor_name) }}</td>
                                        @if (isset($schedule->instructor_name))
                                            <td class="text-center"><a  href="/assistantdean/editassign/{{ $schedule->instructor_id_number }}/{{ $schedule->schedule_id }}" class="text-white btn btn-success">EDIT INSTRUCTOR</a></td>
                                        @else
                                        @php
                                            $schedule = explode(',',$schedule->schedule_id);
                                        @endphp
                                            <td class="text-center"><a href="/assistantdean/assign/{{$schedule[0] }}/{{ isset($schedule[1]) ? $schedule[1] : null }}" class="text-white btn btn-primary">ASSIGN INSTRUCTOR</a></td>
                                        @endif
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <br>
                    </div>
                </div>

            </div>
        </div>
        @endsection

@inject('subject','App\Subject')
@inject('block','App\Block')
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
                <input class="navbar-search form-control" style="display:none;" aria-label="Search"> </div>
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
      <!-- / .main-navbar -->
      <div class="main-content-container container-fluid px-4 card border-0 rounded-0">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
          <div class="col-12 col-sm-2 offset-10 text-sm-left mb-0 float-right">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
            <span class="text-white">Conflicts of </span>
            <span class="text-white">{{$subject->find($conflict_schedules['first_schedule']['schedule']['subject_id'])->sub . ' - '. $subject->find($conflict_schedules['first_schedule']['schedule']['subject_id'])->sub_description}}</span>
            <span class="text-white">{{$conflict_schedules['first_schedule']['schedule']['start_time']}} to </span>
            <span class="text-white">{{$conflict_schedules['first_schedule']['schedule']['end_time']}} - </span>
            <span class="text-white">{{$conflict_schedules['first_schedule']['schedule']['days']}} - </span>
            <span class="text-white">Room {{$conflict_schedules['first_schedule']['schedule']['room']}} - </span>
            </div>
          </div>
      
          <table class="table">
            <thead>
                <th>Start time</th>
                <th>End time</th>
                <th>Days</th>
                <th>Room</th>
                <th>Subject</th>
                <th>Block</th>
                <th class="text-center">Conflict in</th>
            </thead>
            <tbody>
               @foreach($conflict_schedules['first_schedule']['schedule'] as $key => $schedules)
                    @if (isset($key) && $key == 'conflicts')
                        @if (isset($schedules['start_time_and_end_time']))
                              <tr>
                              <th class="text-danger">{{($schedules['start_time_and_end_time']['start_time'])}}</th>
                              <th class="text-danger">{{($schedules['start_time_and_end_time']['end_time'])}}</th>
                              <td>{{($schedules['start_time_and_end_time']['days'])}}</td>
                              <td>{{($schedules['start_time_and_end_time']['room'])}}</td>
                              <td>{{($subject->find($schedules['start_time_and_end_time']['subject_id']))->sub_description}}</td>
                              <td>{{($block->find($schedules['start_time_and_end_time']['block']))->level . ($block->find($schedules['start_time_and_end_time']['block']))->course . ($block->find($schedules['start_time_and_end_time']['block']))->block_name}}</td>
                            <th class="bg-danger text-white text-center">START TIME & END TIME</th>
                           </tr>
                           @elseif(isset($schedules['start_time']))
                              <tr>
                                  <th class="text-danger">{{($schedules['start_time']['start_time'])}}</th>
                                  <td>{{($schedules['start_time']['end_time'])}}</td>
                                  <td>{{($schedules['start_time']['days'])}}</td>
                                  <td>{{($schedules['start_time']['room'])}}</td>
                                  <td>{{($subject->find($schedules['start_time']['subject_id']))->sub_description}}</td>
                                  <td>{{($block->find($schedules['start_time']['block']))->level . ($block->find($schedules['start_time']['block']))->course . ($block->find($schedules['start_time']['block']))->block_name}}</td>
                                <th class="bg-danger text-white text-center">START TIME</th>
                               </tr>
                              @elseif (isset($schedules['end_time']))
                              <tr>
                              <td>{{($schedules['end_time']['start_time'])}}</td>
                              <th class="text-danger">{{($schedules['end_time']['end_time'])}}</th>
                              <td>{{($schedules['end_time']['days'])}}</td>
                              <td>{{($schedules['end_time']['room'])}}</td>
                              <td>{{($subject->find($schedules['end_time']['subject_id']))->sub_description}}</td>
                              <td>{{($block->find($schedules['end_time']['block']))->level . ($block->find($schedules['end_time']['block']))->course . ($block->find($schedules['end_time']['block']))->block_name}}</td>
                            <th class="bg-danger text-white text-center">END TIME</th>
                           </tr>
                        @endif

                      
                          @if (isset($schedules['range']))
                          <tr>
                              <th class="text-danger">{{($schedules['range']['start_time'])}}</th>
                              <th class="text-danger">{{($schedules['range']['end_time'])}}</th>
                              <td>{{($schedules['range']['days'])}}</td>
                              <td>{{($schedules['range']['room'])}}</td>
                              <td>{{($subject->find($schedules['range']['subject_id']))->sub_description}}</td>
                               <td>{{($block->find($schedules['range']['block']))->level . ($block->find($schedules['end_time']['block']))->course . ($block->find($schedules['end_time']['block']))->block_name}}</td>
                              <th class="bg-danger text-white text-center">RANGE</th>
                          </tr>
                          @endif
                    @endif
                @endforeach
            </tbody>
          </table>
         @if (isset($conflict_schedules['second_schedule']))
            <div class="col-md-12 mt-5">
            <div class="alert alert-danger" role="alert">
            <span class="text-white">Conflicts of </span>
            <span class="text-white">{{$subject->find($conflict_schedules['second_schedule']['schedule']['subject_id'])->sub . ' - '. $subject->find($conflict_schedules['second_schedule']['schedule']['subject_id'])->sub_description}}</span>
            <span class="text-white">{{$conflict_schedules['second_schedule']['schedule']['start_time']}} to </span>
            <span class="text-white">{{$conflict_schedules['second_schedule']['schedule']['end_time']}} - </span>
            <span class="text-white">{{$conflict_schedules['second_schedule']['schedule']['days']}} - </span>
            <span class="text-white">Room {{$conflict_schedules['second_schedule']['schedule']['room']}} - </span>
            </div>
          </div>
          <table class="table">
            <thead>
                <th>Start time</th>
                <th>End time</th>
                <th>Days</th>
                <th>Room</th>
                <th>Subject</th>
                <th>Block</th>
                <th class="text-center">Conflict in</th>
            </thead>
            <tbody>
               @foreach($conflict_schedules['second_schedule']['schedule'] as $key => $schedules)
                    @if (isset($key) && $key == 'conflicts')
                    @if (isset($schedules['start_time']))
                              <tr>
                              <th class="text-danger">{{($schedules['start_time']['start_time'])}}</th>
                              <td>{{($schedules['start_time']['end_time'])}}</td>
                              <td>{{($schedules['start_time']['days'])}}</td>
                              <td>{{($schedules['start_time']['room'])}}</td>
                              <td>{{($subject->find($schedules['start_time']['subject_id']))->sub_description}}</td>
                              <td>{{($block->find($schedules['start_time']['block']))->level . ($block->find($schedules['start_time']['block']))->course . ($block->find($schedules['start_time']['block']))->block_name}}</td>
                            <th class="bg-danger text-white text-center">START TIME</th>
                           </tr>
                        @endif
                        @if (isset($schedules['end_time']))
                              <tr>
                              <td>{{($schedules['end_time']['start_time'])}}</td>
                              <th class="text-danger">{{($schedules['end_time']['end_time'])}}</th>
                              <td>{{($schedules['end_time']['days'])}}</td>
                              <td>{{($schedules['end_time']['room'])}}</td>
                              <td>{{($subject->find($schedules['end_time']['subject_id']))->sub_description}}</td>
                              <td>{{($block->find($schedules['end_time']['block']))->level . ($block->find($schedules['end_time']['block']))->course . ($block->find($schedules['end_time']['block']))->block_name}}</td>
                            <th class="bg-danger text-white text-center">END TIME</th>
                           </tr>
                        @endif
                          @if (isset($schedules['range']))
                          <tr>
                              <th class="text-danger">{{($schedules['range']['start_time'])}}</th>
                              <th class="text-danger">{{($schedules['range']['end_time'])}}</th>
                              <td>{{($schedules['range']['days'])}}</td>
                              <td>{{($schedules['range']['room'])}}</td>
                              <td>{{($subject->find($schedules['range']['subject_id']))->sub_description}}</td>
                               <td>{{($block->find($schedules['range']['block']))->level . ($block->find($schedules['end_time']['block']))->course . ($block->find($schedules['end_time']['block']))->block_name}}</td>
                              <th class="bg-danger text-white text-center">RANGE</th>
                          </tr>
                          @endif
                    @endif
                @endforeach
            </tbody>
          </table>
           
         @endif
         
        </div>
      </div>
    </div>
  </div>
  @endsection

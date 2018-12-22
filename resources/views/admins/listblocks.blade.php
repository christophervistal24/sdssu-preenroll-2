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
                    <h4 class="text-muted ml-2">List of all blocks</h4>
                    <div class="container">
                        <div class="form-group">
                            <button class="btn btn-primary border-0 rounded-0" id="btnAddNewBlock">Add new block</button>
                        </div>
                        {{-- id="block_tables"  --}}
                        <table class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Block</th>
                                    <th class="text-center">No. of enrolled</th>
                                    <th class="text-center">Maximum for block</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBlockBody">
                                @foreach ($blocks as $block)
                                <tr>
                                    <td class="text-center">{{ $block->level . $block->course . strtoupper( $block->block_name) }}</td>
                                    <td class="text-center">{{ $block->no_of_enrolled }}</td>
                                    <td class="text-center">{{ $block->block_limit }}</td>
                                    <td class="text-center {{ ($block->status != 'closed') ? 'text-success' : 'text-danger' }}"><b>{{ strtoupper($block->status) }}</b></td>
                                   <td class="text-center"><button id="btnEditBlock" params="
                                        {{  json_encode(
                                                [
                                                    'id'             => $block->id,
                                                    'course'         => $block->course,
                                                    'year'           => $block->level,
                                                    'block'          => strtoupper($block->block_name),
                                                    'blockLimit'     => $block->block_limit,
                                                    'no_of_enrolled' => $block->no_of_enrolled
                                                ]
                                        )
                                        }}
                                        " class="btn btn-success border-0 rounded-0 text-white">EDIT</button></td>
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
            <div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content border-0 rounded-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Add new block.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id='validation-errors'>

                            </div>
                            <form method="POST" id="blockForm" autocomplete="off" data-action="add">
                                <div class="form">
                                    @csrf
                                    <div class="form-group">
                                        <label>Course : </label>
                                        <select name="course" id="course" class="form-control">
                                            @foreach ($course::all() as $crse)
                                            <option value="{{ $crse->course_code }}">{{ $crse->course_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Year level : </label>
                                        <select name="year" id="year" class="form-control">
                                            @foreach (range(1,5) as $year_level)
                                            <option value="{{ $year_level }}">{{ $year_level }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Block name : </label>
                                        <input type="text" required id="blockName" name="block_name" placeholder="e.g A" class="form-control">
                                    </div>


                                    <div class="form-group">
                                        <label>Maximum student's can enroll for this block : </label>
                                        <input type="number" required id="blockLimit" name="block_limit" placeholder="e.g 35" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="blockBtn">Add block</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- MODAL END --}}
            @endsection

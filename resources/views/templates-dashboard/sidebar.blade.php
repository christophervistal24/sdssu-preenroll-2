@if (request()->is('admin/*'))
@php
$route="admin";
@endphp
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                <div class="d-table m-auto">
                    <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{ url('/storage/img/sdssu.png') }}" alt="Shards Dashboard">
                    <span class="d-none d-md-inline ml-1">{{ ucfirst($route) }} Dashboard</span>
                </div>
            </a>
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
        </nav>
    </div>
    <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
        <div class="input-group input-group-seamless ml-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
        </form>
        <div class="nav-wrapper">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url("/$route/index") }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ url("/$route/pre-enrol") }}">
                        <i class="material-icons">assignment_turned_in</i>
                        <span>Pre Enroll</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ url("/$route/listofrooms") }}">
                        <i class="material-icons">meeting_room</i>
                        <span>Rooms</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link active" href="{{ url("/$route/addgrades") }}">
                        <i class="material-icons">edit</i>
                        <span>Input Grades</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ url("/$route/subjects") }}">
                        <i class="material-icons">subject</i>
                        <span>Subjects</span>
                    </a>
                </li>
                  <li class="nav-item">
                    <div class="dropdown show">
                        <a class="nav-link" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">person</i>
                            <span>Students</span>
                            <i class="material-icons">arrow_drop_down</i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                             <a class="dropdown-item" href="{{ url("/$route/liststudents") }}" >
                                <i class="material-icons">add_circle</i>
                                <span>List of students</span>
                            </a>
                            <a class="dropdown-item" href="{{ url("/$route/addstudent") }}" >
                                <i class="material-icons">add_circle</i>
                                <span>Add student</span>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown show">
                        <a class="nav-link" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">person</i>
                            <span>Instructors</span>
                            <i class="material-icons">arrow_drop_down</i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ url("/$route/instructors") }}" >
                                <i class="material-icons">view_list</i>
                                <span>List of Instructors</span>
                            </a>
                            <a class="dropdown-item" href="{{ url("/$route/addinstructor") }}" >
                                <i class="material-icons">add_circle</i>
                                <span>Add Instructor</span>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown show">
                        <a class="nav-link" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">view_module</i>
                            <span>Schedules</span>
                            <i class="material-icons">arrow_drop_down</i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ url("/$route/schedule") }}" >
                                <i class="material-icons">view_list</i>
                                <span>List of Schedules</span>
                            </a>
                            <a class="dropdown-item" href="{{ url("/$route/scheduling") }}" >
                                <i class="material-icons">add_circle</i>
                                <span>Add Schedule</span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
    <!-- End Main Sidebar -->
    @endif
    @if (request()->is('student/*'))
    @php
    $route = 'student';
    @endphp
    <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
        <div class="main-navbar">
            <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                    <div class="d-table m-auto">
                        <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{ url('/storage/img/sdssu.png') }}" alt="Shards Dashboard">
                        <span class="d-none d-md-inline ml-1">{{ ucfirst($route) }}  Dashboard</span>
                    </div>
                </a>
                <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                    <i class="material-icons">&#xE5C4;</i>
                </a>
            </nav>
        </div>
        <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
            <div class="input-group input-group-seamless ml-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
            </form>
            <div class="nav-wrapper">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ url("/$route/index") }}">
                            <i class="material-icons">edit</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ url("/$route/preenrol") }}">
                            <i class="material-icons">edit</i>
                            <span>Pre-Enroll</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ url("/$route/evaluate") }}">
                            <i class="material-icons">edit</i>
                            <span>Evaluate</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url("/$route/schedule") }}">
                            <i class="material-icons">note_add</i>
                            <span>Schedule</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        @endif
        @if (request()->is('parent/*'))
        @php
        $route = 'parent';
        @endphp
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
            <div class="main-navbar">
                <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                    <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                        <div class="d-table m-auto">
                            <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{ url('/storage/img/sdssu.png') }}" alt="Shards Dashboard">
                            <span class="d-none d-md-inline ml-1">{{ ucfirst($route) }}  Dashboard</span>
                        </div>
                    </a>
                    <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                        <i class="material-icons">&#xE5C4;</i>
                    </a>
                </nav>
            </div>
            <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
                <div class="input-group input-group-seamless ml-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
                </form>
                <div class="nav-wrapper">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url("/$route/index") }}">
                                <i class="material-icons">edit</i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url("/$route/viewgrade") }}">
                                <i class="material-icons">note_add</i>
                                <span>View Grade</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
            @endif
            @if (request()->is('instructor/*'))
            @php
            $route = 'instructor';
            @endphp
            <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
                <div class="main-navbar">
                    <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                        <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                            <div class="d-table m-auto">
                                <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{ url('/storage/img/sdssu.png') }}" alt="Shards Dashboard">
                                <span class="d-none d-md-inline ml-1">{{ ucfirst($route) }}  Dashboard</span>
                            </div>
                        </a>
                        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                            <i class="material-icons">&#xE5C4;</i>
                        </a>
                    </nav>
                </div>
                <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
                    <div class="input-group input-group-seamless ml-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                        <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
                    </form>
                    <div class="nav-wrapper">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ url("/$route/index") }}">
                                    <i class="material-icons">dashboard</i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url("/$route/schedule") }}">
                                    <i class="material-icons">note_add</i>
                                    <span>Schedules</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>
                @endif

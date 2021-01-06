<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{route('home')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-dark.png')}}" alt="" height="20">
            </span>
        </a>

        <a href="{{route('home')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-light.png')}}" alt="" height="20">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Administrations</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-university"></i>
                        <span>Faculties</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.faculties.index')}}"><i class="fas fa-table"></i>View Faculties</a></li>
                        <li><a href="{{route('admin.faculties.add')}}"><i class="fas fa-plus"></i>Add a Faculty</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-book-open"></i>
                        <span>Programmes</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.programmes.index')}}"><i class="fas fa-table"></i>View Programmes</a></li>
                        <li><a href="{{route('admin.programmes.add')}}"><i class="fas fa-plus"></i>Add a Programme</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-calendar-day"></i>
                        <span>Academic Years</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.academic.years.index')}}"><i class="fas fa-table"></i>View Academic Years</a></li>
                        <li><a href="{{route('admin.academic.years.add')}}"><i class="fas fa-plus"></i>Add an Academic Year</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Login Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('users.index')}}"><i class="fas fa-table"></i>View Users</a></li>
                        <li><a href="{{route('users.add')}}"><i class="fas fa-plus"></i>Add an User</a></li>

                    </ul>
                </li>

                <li class="menu-title">Students</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user-graduate"></i>
                        <span>Students</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.students.index')}}"><i class="fas fa-table"></i>View Students</a></li>
                        <li><a href="{{route('admin.students.add')}}"><i class="fas fa-plus"></i>Add a Student</a></li>
                        <li><a href="{{route('admin.students.upload')}}"><i class="fas fa-upload"></i>Bulk Upload UGC List</a></li>

                    </ul>
                </li>
                <li class="menu-title">Applications</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user-plus"></i>
                        <span>Registrations</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.application.registrations.index')}}"><i class="fas fa-table"></i>View Registrations</a></li>
                        <li><a href="{{route('admin.application.registrations.add')}}"><i class="fas fa-plus"></i>Call a Registration</a></li>
                    </ul>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

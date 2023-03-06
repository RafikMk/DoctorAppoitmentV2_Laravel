<div class="page-wrap">
    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="index.html">
                <div class="logo-img">
                    {{-- <img src="{{ asset('admin/src/img/brand-white.svg') }}" class="header-brand-img" alt="lavalite">  --}}
                </div>
                <span class="text">Dashboard</span>
            </a>
            <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
            <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
        </div>
        
        <div class="sidebar-content">
            <div class="nav-container">
                <nav id="main-menu-navigation" class="navigation-main">
                    <div class="nav-lavel">Navigation</div>
                    <div class="nav-item active">
                        <a href="{{ url('dashboard') }}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                    </div>
                    @if (auth()->check() && auth()->user()->role->name == 'Admin')
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Specialite</span> <span class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            <a href="{{ route('specialite.create') }}" class="menu-item">Create</a>
                            <a href="{{ route('specialite.index') }}" class="menu-item">View</a>
                        </div>
                    </div>
                    @endif
                    @if (auth()->check() && auth()->user()->role->name == 'Admin')
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Doctors</span> <span class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            <a href="{{ route('doctor.create') }}" class="menu-item">Create</a>
                            <a href="{{ route('doctor.index') }}" class="menu-item">View</a>
                        </div>
                    </div>
                    @endif
                    @if (auth()->check() && auth()->user()->role->name == 'Doctor')
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Calendrier</span> <span class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            <a href="{{ route('appointment.create') }}" class="menu-item">Create</a>
                            <a href="{{ route('appointment.index') }}" class="menu-item">View</a>
                        </div>
                    </div> 
                    @endif 
                    @if (auth()->check() && auth()->user()->role->name == 'Doctor')
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Prescriptions</span> <span class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                        <a href="{{ route('prescription.create') }}" class="menu-item">Create</a>

                            <a href="{{ route('prescription.today') }}" class="menu-item">Today</a>
                            <a href="{{ route('prescription.all') }}" class="menu-item">All</a>
                        </div>
                    </div> 
                    @endif 
                    @if (auth()->check() && auth()->user()->role->name == 'Admin')
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Patient Bookings</span> <span class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            <!--                            <a href="{{ route('bookings.today') }}" class="menu-item">Today</a>
 -->

                            <a href="{{ route('bookings.all') }}" class="menu-item">All</a>
                        </div>
                    </div>
                    @endif
                    @if (auth()->check() && auth()->user()->role->name == 'Doctor')
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Messages</span> <span class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            <a href="{{ route('chats') }}" class="menu-item">All</a>
                        </div>
                    </div>
                    @endif
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Update profile </span> <span class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            <a href="{{ route('profile') }}" class="menu-item">Profile</a>
                        </div>
                    </div>
                    <div class="nav-item active">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="ik ik-power dropdown-icon"></i><span>Logout</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>
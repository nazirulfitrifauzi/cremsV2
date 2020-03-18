<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/csc_blue.png" class="navbar-brand-img" alt="..." style="max-height:4.5rem;">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/csc_blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>

                @if (auth()->user()->roles->p_attendance == '1' || auth()->user()->roles->p_leave == '1' || auth()->user()->roles->p_claim == '1' || auth()->user()->roles->p_advance == '1')
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#human-resource" 
                            @if ($title == 'Claim')
                                style="color: #f4645f" aria-expanded="true"
                            @else
                                aria-expanded="false"
                            @endif
                            data-toggle="collapse" role="button">
                            <i class="fas fa-briefcase"></i>
                            <span class="nav-link-text">Human Resource</span>
                        </a>

                        <div class="collapse @if ($title == 'Claim') show @endif " id="human-resource">
                            <ul class="nav nav-sm flex-column">

                                @if (auth()->user()->roles->p_attendance == '1')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('attendances.index') }}">
                                            Attendance
                                        </a>
                                    </li>
                                @else
                                @endif

                                @if (auth()->user()->roles->p_leave == '1')
                                    <li class="nav-item">
                                        <a class="nav-link" href="#staff-leave" data-toggle="collapse" role="button" aria-expanded="false">
                                            Leave
                                        </a>
                                    </li>

                                    <div class="collapse" id="staff-leave">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('staff-leave.create') }}">
                                                    Apply Leave
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('staff-leave.list') }}">
                                                    Application List
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('staff-leave.index') }}">
                                                    Calendar
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                @endif
                                
                                @if (auth()->user()->roles->p_claim == '1')
                                    <li class="nav-item">
                                        <a class="nav-link" 
                                        @if ($title == 'Claim')
                                            style="color: #f4645f" aria-expanded="true"
                                        @else
                                            aria-expanded="false"
                                        @endif
                                        href="#staff-claim" data-toggle="collapse" role="button">
                                            Claim
                                        </a>
                                    </li>

                                    <div class="collapse @if ($title == 'Claim') show @endif" id="staff-claim">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" 
                                                {{-- @if ($slug == 'claim_create') style="color: #f4645f" @endif  --}}
                                                href="{{ route('staff-claim.create') }}">
                                                    Apply Claim
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" 
                                                {{-- @if ($slug == 'claim_list') style="color: #f4645f" @endif  --}}
                                                href="{{ route('staff-claim.index') }}">
                                                    Claim List
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                @endif

                                @if (auth()->user()->roles->p_advance == '1')
                                    <li class="nav-item">
                                        <a class="nav-link" href="#staff-advance" data-toggle="collapse" role="button">
                                            Advance
                                        </a>
                                    </li>

                                    <div class="collapse @if ($title == 'Advance') show @endif" id="staff-advance">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" 
                                                href="{{ route('staff-advance.create') }}">
                                                    Apply Advance
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" 
                                                href="{{ route('staff-advance.index') }}">
                                                    Advance List
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                @endif

                            </ul>
                        </div>
                    </li>

                @else
                @endif

            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Settings</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.activatepage') }}">
                        <i class="fas fa-plus-square"></i> New Request
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('roles.index') }}">
                        <i class="ni ni-ui-04"></i> Roles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('staff.index') }}">
                        <i class="fas fa-user-tie"></i> Staff
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#client" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                        <i class="fas fa-address-book"></i>
                        <span class="nav-link-text">Clients</span>
                    </a>

                    <div class="collapse" id="client">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.index') }}">
                                    Company List 
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.user') }}">
                                    Users
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('company.index') }}">
                        <i class="far fa-building"></i> Company
                    </a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link" href="{{ route('issues.index') }}">
                        <i class="fas fa-exclamation"></i> Issues
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
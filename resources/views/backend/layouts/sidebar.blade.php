<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">

        @if (auth()->user()->role == 'admin')
            <a href="{{ route('backend.home') }}" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>RNR</h3>
            </a>
        @else
            <a href="{{ route('user.backend.home') }}" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>RNR</h3>
            </a>
        @endif

        <div class="d-flex align-items-center ms-4 mb-4">
            {{-- <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('public/backend/dashmin/img/user.jpg') }}" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div> --}}
            {{-- <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                <span>Admin</span>
            </div> --}}
        </div>
        <div class="navbar-nav w-100">
            @if (auth()->user()->role == 'admin')
                <a href="{{ route('backend.home') }}" class="nav-item nav-link"><i class="bi bi-speedometer2"></i>
                    Dashboard</a>
            @else
                <a href="{{ route('user.backend.home') }}" class="nav-item nav-link"><i class="bi bi-speedometer2"></i>
                    Dashboard</a>
            @endif


            @if (auth()->user()->role == 'admin')
                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle " data-bs-toggle="dropdown"><i
                            class="bi bi-person"></i> Users</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('users.index') }}" class="dropdown-item">View All</a>
                        {{-- <a href="{{ route('users.create') }}" class="dropdown-item">New</a> --}}

                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="bi bi-columns-gap"></i> Applications</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('application.index') }}" class="dropdown-item">View All</a>
                        {{-- <a href="{{ route('application.create') }}" class="dropdown-item">New</a> --}}

                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle " data-bs-toggle="dropdown"><i
                            class="bi bi-people"></i> Groups</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('group.index') }}" class="dropdown-item">View All</a>
                        {{-- <a href="{{ route('group.create') }}" class="dropdown-item">New</a> --}}

                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle " data-bs-toggle="dropdown"><i
                            class="bi bi-boxes"></i> Roles</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('role.index') }}" class="dropdown-item">View All</a>
                        {{-- <a href="{{ route('group.create') }}" class="dropdown-item">New</a> --}}

                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle " data-bs-toggle="dropdown"><i
                            class="bi bi-link-45deg"></i> Integration</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="#" class="dropdown-item">View All</a>
                        {{-- <a href="{{ route('group.create') }}" class="dropdown-item">New</a> --}}

                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle " data-bs-toggle="dropdown"><i
                            class="bi bi-person-workspace"></i> C. Dashboard</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('dashboard.index') }}" class="dropdown-item">View All</a>
                        {{-- <a href="{{ route('group.create') }}" class="dropdown-item">New</a> --}}

                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle " data-bs-toggle="dropdown"><i
                            class="bi bi-person-workspace"></i> Reports</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('report.index') }}" class="dropdown-item">View All</a>
                        {{-- <a href="{{ route('group.create') }}" class="dropdown-item">New</a> --}}

                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle " data-bs-toggle="dropdown"><i
                            class="bi bi-list-columns-reverse"></i> Logs</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ url('logs') }}" class="dropdown-item">View All</a>
                        {{-- <a href="{{ route('group.create') }}" class="dropdown-item">New</a> --}}

                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle " data-bs-toggle="dropdown"><i
                            class="bi bi-key"></i> MFA</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="#" class="dropdown-item">View All</a>
                        {{-- <a href="{{ route('group.create') }}" class="dropdown-item">New</a> --}}

                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle " data-bs-toggle="dropdown"><i
                            class="bi bi-exclamation-triangle"></i> Notifications</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('notifications.index') }}" class="dropdown-item">View All</a>
                        {{-- <a href="{{ route('group.create') }}" class="dropdown-item">New</a> --}}

                    </div>
                </div>

            @endif

            @if (auth()->user()->role != 'admin')
                @php
                    $loggedinuser = auth()->user();
                    $userroles = $loggedinuser->userroles()->pluck('roleids');
                    $applicationids = App\Models\backend\Application_roles::where('roleid', $userroles)->where('read', '!=', '0')->pluck('applicationid');
                    // print_r($applicationids);
                    $applications = App\Models\backend\Application::find($applicationids);
                    
                @endphp

                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-tasks me-2"></i>Applications</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        {{-- <a href="{{ route('user-application.index') }}" class="dropdown-item">View All</a> --}}
                        {{-- <a href="{{ route('application.create') }}" class="dropdown-item">New</a> --}}
                        @foreach ($applications as $item)
                            <a class="dropdown-item" href="{{ route('userapplication.list', $item->id) }}">
                                {{ $item->name }}</a>
                        @endforeach

                    </div>
                </div>
            @endif

        </div>
    </nav>
</div>

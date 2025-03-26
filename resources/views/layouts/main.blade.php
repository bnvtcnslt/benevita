<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{asset('assets-be/css/style.css')}}" rel="stylesheet">
</head>
<body>
<div class="wrapper d-flex">
    <!-- Enhanced Sidebar -->
    <div id="sidebar">
        <div class="sidebar-header d-flex justify-content-between align-items-center p-3">
            <a href="{{route('home')}}" class="m-0 h3 text-decoration-none">Benevita</a>
            <button type="button" id="sidebar-close" class="btn d-md-none">
                <i class="bi bi-x text-white fs-4"></i>
            </button>
        </div>

        <ul class="list-unstyled components p-2" style="overflow-y: auto; max-height: 500px; scrollbar-width: none;">
            <li class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <a href="{{route('dashboard.index')}}" class="text-white text-decoration-none d-block">
                    <i class="bi bi-speedometer2"></i>Dashboard
                </a>
            </li>
            <li class="{{ request()->routeIs('client.index') ? 'active' : '' }}">
                <a href="{{route('client.index')}}" class="text-white text-decoration-none d-block">
                    <i class="bi bi-person-circle"></i>Client
                </a>
            </li>
            <li class="{{ request()->routeIs('team.index') ? 'active' : '' }}">
                <a href="{{route('team.index')}}" class="text-white text-decoration-none d-block">
                    <i class="bi bi-unity"></i>Team
                </a>
            </li>
            <li class="{{ request()->routeIs('team_members.index') ? 'active' : '' }}">
                <a href="{{route('team_members.index')}}" class="text-white text-decoration-none d-block">
                    <i class="bi bi-people-fill"></i>Team Member
                </a>
            </li>
            <li class="{{ request()->routeIs('service.index') ? 'active' : '' }}">
                <a href="{{route('service.index')}}" class="text-white text-decoration-none d-block">
                    <i class="bi bi-card-list"></i>Service
                </a>
            </li>
            <li class="{{ request()->routeIs('social_media.index') ? 'active' : '' }}">
                <a href="{{route('social_media.index')}}" class="text-white text-decoration-none d-block">
                    <i class="bi bi-share-fill"></i>Social Media
                </a>
            </li>
        </ul>
    </div>

    <!-- Page Content -->
    <div id="content">
        <!-- Enhanced Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn">
                    <i class="bi bi-list"></i>
                </button>

                @isset($users)
                    @php
                        $user = auth()->user();
                    @endphp
                    <div class="ms-auto d-flex align-items-center">
                        <div class="fw-bold me-3">Hi, {{ $user->name }}</div>
                        <div class="dropdown">
                            <div class="position-relative" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://picsum.photos/30" class="rounded-circle border" alt="Profile">
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li><a href="#" class="dropdown-item"><i class="bi bi-gear"></i> Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('auth.logout') }}"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                @endisset
            </div>
        </nav>

        <!-- Main Content Area -->
        <div class="main-content">
            @yield('content')
        </div>

        <!-- Enhanced Footer -->
        <footer class="text-center">
            <p class="mb-0">&copy; 2024 Benevita Consulting. All rights reserved.</p>
        </footer>
    </div>
</div>

<!-- Bootstrap 5.3 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
{{--SweetAlert--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('sidebarCollapse').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('content').classList.toggle('sidebar-active');
    });

    document.getElementById('sidebar-close').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('content').classList.toggle('sidebar-active');
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500,
            width: '300px',
            toast: true,
            padding: '0.5rem',
            customClass: {
                popup: 'small-toast',
                title: 'small-toast-title'
            }
        });
        @endif

        @if(session('error'))
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 1500,
            width: '350px',
            toast: true,
            padding: '0.5rem',
            customClass: {
                popup: 'small-toast',
                title: 'small-toast-title'
            }
        });
        @endif
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session()->has('sweet_error'))
        Swal.fire({
            title: "No Results",
            text: "{{ session('sweet_error') }}",
            icon: "error",
            confirmButtonColor: "#3085d6"
        });
        @endif

        const searchInput = document.querySelector('input[name="query"]');
        if (searchInput) {
            const searchForm = searchInput.closest('form');
            searchInput.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    searchForm.submit();
                }
            });
        }
    });
</script>
</body>
</html>

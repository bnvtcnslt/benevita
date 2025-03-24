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
    <style>
        :root {
            --dark-green: #1e4d36;
            --light-green: #2a6a4a;
            --orange: #f27241;
            --light-orange: #ff9466;
            --sidebar-width: 280px;
            --body-bg: #f4f7fa;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--body-bg);
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            flex-grow: 1;
            width: 100%;
        }

        /* Enhanced Sidebar */
        #sidebar {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            background: linear-gradient(135deg, var(--dark-green), var(--light-green));
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            overflow-y: auto;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 16px 16px 16px 16px;
            padding: 10px;
        }

        #sidebar .sidebar-header {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            margin-bottom: 15px;
            margin-top: 5px;
        }

        #sidebar ul li {
            margin: 8px 0;
            border-radius: 10px;
            overflow: hidden;
        }

        #sidebar ul li a {
            padding: 12px 20px;
            font-weight: 500;
            border-radius: 10px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        #sidebar ul li a:hover, #sidebar ul li.active a {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        #sidebar ul li a i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .profile-container {
            border-radius: 12px;
            padding: 16px;
            margin: 15px 10px;
        }

        .profile-container img {
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        /* Main Content Area */
        #content {
            background-color: var(--body-bg);
            padding: 0;
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            transition: margin-left 0.3s;
        }

        #content.sidebar-active {
            margin-left: 0;
            width: 100%;
        }

        /* Navbar */
        .navbar {
            background-color: #fff;
            box-shadow: var(--card-shadow);
            padding: 12px 25px;
            border-radius: 12px;
            margin: 15px;
        }

        #sidebarCollapse {
            background-color: var(--orange);
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #sidebarCollapse:hover {
            background-color: var(--light-orange);
            transform: scale(1.05);
        }

        #sidebarCollapse i {
            color: white;
            font-size: 1.5rem;
        }

        /* Main Content */
        .main-content {
            padding: 20px;
        }

        /* Footer */
        footer {
            padding: 15px 0;
            border-radius: 16px;
            margin: 15px;
        }

        /* Active state */
        #sidebar.active {
            margin-left: calc(var(--sidebar-width) * -1);
        }

        #sidebar.active + #content {
            margin-left: 0;
            width: 100%;
        }

        /* Media queries for responsiveness */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: calc(var(--sidebar-width) * -1);
                border-radius: 0 12px 12px 0;
            }

            #sidebar.active {
                margin-left: 0;
            }

            #content {
                margin-left: 0;
                width: 100%;
            }
        }

        /* Card Styling */
        .card {
            border-radius: 16px;
            border: none;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .card .rounded-circle{
            border-radius: 50% !important;
            background-color: rgba(0,0,0,0.05);
            padding: 5px;
        }
    </style>
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

        <ul class="list-unstyled components p-2">
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
                    <i class="bi bi-people-fill"></i>Team
                </a>
            </li>
            <li class="{{ request()->routeIs('service.index') ? 'active' : '' }}">
                <a href="{{route('service.index')}}" class="text-white text-decoration-none d-block">
                    <i class="bi bi-card-list"></i>Service
                </a>
            </li>
            <li class="{{--{{ request()->routeIs('settings.*') ? 'active' : '' }}--}}">
                <a href="{{--{{ route('settings.index') ?? '#' }}--}}" class="text-white text-decoration-none d-block">
                    <i class="bi bi-gear"></i>Settings
                </a>
            </li>
        </ul>

        <!-- Enhanced Profile container -->
        <div class="profile-container mt-auto">
            <div class="dropdown">
                <div class="d-flex align-items-center" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://picsum.photos/30" alt="Profile" class="me-3">
                    <div>
                        <p class="m-0 fw-bold">John Doe</p>
                        <small class="text-white-50">Administrator</small>
                    </div>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end profile-dropdown" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-key me-2"></i>Change Password</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div id="content">
        <!-- Enhanced Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn">
                    <i class="bi bi-list"></i>
                </button>
                <div class="ms-auto d-flex align-items-center">
                    <div class="position-relative me-3">
                        <i class="bi bi-bell fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </div>
                    <div class="position-relative me-3">
                        <i class="bi bi-envelope fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                            5
                        </span>
                    </div>
                </div>
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
            width: '250px',
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
        // Handle empty search results with SweetAlert
        @if(session()->has('sweet_error'))
        Swal.fire({
            title: "No Results",
            text: "{{ session('sweet_error') }}",
            icon: "error",
            confirmButtonColor: "#3085d6"
        });
        @endif

        // Your existing empty search field handler
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

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
            --dark-green: #2c5640;
            --light-green: #3d7a5a;
            --orange: #f5844c;
            --light-orange: #ffa773;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Mencegah scroll horizontal */
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .wrapper {
            display: flex;
            flex-grow: 1;
            width: 100%;
        }

        #content {
            flex-grow: 1;
            background-color: white;
            padding: 0;
        }

        .main-content {
            flex: 1;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: var(--light-green);
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
        }

        #sidebar.active {
            margin-left: -250px;
        }

        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid white;
        }

        .profile-dropdown {
            background-color: var(--light-green);
            border: none;
        }

        .profile-dropdown .dropdown-item:hover {
            background-color: var(--orange);
            color: white;
        }

        .profile-dropdown .dropdown-item {
            color: white;
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
                position: fixed;
                z-index: 1000;
                height: 100%;
            }

            #sidebar.active {
                margin-left: 0;
            }

            #sidebarCollapse span {
                display: none;
            }
        }

        .custom-btn {
            background-color: var(--orange);
            border: none;
        }

        .custom-btn:hover {
            background-color: var(--light-orange);
        }
    </style>
</head>
<body>
<div class="wrapper d-flex">
    <!-- Sidebar -->
    <div class="col-12 col-md-3 col-lg-2 bg-light-green text-white" id="sidebar">
        <div class="sidebar-header d-flex justify-content-between align-items-center p-3 bg-dark-green">
            <a href="{{route('home')}}" class="m-0 h3 text-decoration-none">Benevita</a>
            <button type="button" id="sidebar-close" class="btn d-md-none">
                <i class="bi bi-x text-white fs-4"></i>
            </button>
        </div>

        <ul class="list-unstyled components p-0">
            <li class="active">
                <a href="{{route('dashboard.index')}}" class="text-white text-decoration-none p-3 d-block"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            </li>
            <li>
                <a href="{{route('client.index')}}" class="text-white text-decoration-none p-3 d-block"><i class="bi bi-person-circle me-2"></i>Client</a>
            </li>
            <li>
                <a href="#" class="text-white text-decoration-none p-3 d-block"><i class="bi bi-people me-2"></i>User</a>
            </li>
            <li>
                <a href="#" class="text-white text-decoration-none p-3 d-block"><i class="bi bi-gear me-2"></i>Settings</a>
            </li>
        </ul>

        <!-- Profile container at the bottom of sidebar -->
        <div class="profile-container mt-auto p-3 bg-dark-green">
            <div class="dropdown">
                <div class="d-flex align-items-center" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="/api/placeholder/40/40" alt="Profile" class="profile-image me-3">
                    <div>
                        <p class="m-0 fw-bold">John Doe</p>
                        <small>Administrator</small>
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
    <div class="col-12 col-md-9 col-lg-10" id="content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-6 col-md-8">
                        <button type="button" id="sidebarCollapse" class="btn custom-btn">
                            <i class="bi bi-list text-white"></i>
                        </button>

                        {{--<div class="ms-auto d-flex align-items-center">
                            <div class="me-4 position-relative">
                                <i class="bi bi-bell fs-5"></i>
                                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                            </div>
                            <div class="position-relative">
                                <i class="bi bi-envelope fs-5"></i>
                                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                            </div>
                        </div>--}}
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-12 col-md-8">
                    <h2>@yield('title')</h2>
                    <p class="text-muted">@yield('subtitle')</p>
                </div>
            </div>
        </div>

        @yield('content')

        <!-- Footer -->
        <footer class="mt-auto bg-light-green text-dark py-3">
            <div class="col-lg-12 col-12 col-md-8">
                <div class="container-fluid text-center">
                    <p>&copy; 2024 Benevita Consulting. All rights reserved.</p>
                </div>
            </div>
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
    });

    document.getElementById('sidebar-close').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('active');
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benevita Dashboard</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css?v=' . time()) }}" rel="stylesheet">
</head>
<body>
<div class="wrapper d-flex">
    <!-- Enhanced Sidebar -->
    <div id="sidebar" class="d-flex flex-column">
        <!-- Sidebar Header with Centered Icon -->
        <div class="sidebar-header d-flex flex-column align-items-center justify-content-center p-3 bg-dark position-relative">
            <!-- Centered Icon and Text -->
            <a href="{{ route('home') }}" class="text-decoration-none text-white text-center">
                <div class="fw-bold fs-5">Benevita</div>
            </a>
            <!-- Close Button (mobile only) -->
            <button type="button" id="sidebar-close" class="btn d-md-none p-0 position-absolute end-0 me-2 top-50 translate-middle-y">
                <i class="bi bi-x-lg text-white"></i>
            </button>
        </div>

        <!-- Sidebar Menu -->
        <ul class="list-unstyled components p-3 flex-grow-1" style="overflow-y: auto;">
            <!-- Dashboard -->
            <li class="mb-2 {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}" class="text-white text-decoration-none d-flex align-items-center py-2 px-3 rounded">
                    <i class="bi bi-house-door me-3 fs-5"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Client Management -->
            <li class="mb-2 {{ request()->routeIs('client.index') ? 'active' : '' }}">
                <a href="{{ route('client.index') }}" class="text-white text-decoration-none d-flex align-items-center py-2 px-3 rounded">
                    <i class="bi bi-building me-3 fs-5"></i>
                    <span>Clients</span>
                </a>
            </li>

            <!-- Team Sections -->
            <li class="mb-2">
                <a href="#teamSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="text-white text-decoration-none d-flex align-items-center py-2 px-3 rounded dropdown-toggle">
                    <i class="bi bi-people me-3 fs-5"></i>
                    <span>Team Management</span>
                </a>
                <ul class="collapse list-unstyled ps-4 mt-2" id="teamSubmenu">
                    <li class="mb-2 {{ request()->routeIs('team.index') ? 'active' : '' }}">
                        <a href="{{ route('team.index') }}" class="text-white text-decoration-none d-flex align-items-center py-2 px-3 rounded">
                            <i class="bi bi-diagram-2 me-3 fs-6"></i>
                            <span>Team Structure</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('team_members.index') ? 'active' : '' }}">
                        <a href="{{ route('team_members.index') }}" class="text-white text-decoration-none d-flex align-items-center py-2 px-3 rounded">
                            <i class="bi bi-person-badge me-3 fs-6"></i>
                            <span>Team Members</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Services -->
            <li class="mb-2 {{ request()->routeIs('service.index') ? 'active' : '' }}">
                <a href="{{ route('service.index') }}" class="text-white text-decoration-none d-flex align-items-center py-2 px-3 rounded">
                    <i class="bi bi-stack me-3 fs-5"></i>
                    <span>Services</span>
                </a>
            </li>

            <!-- Marketing -->
            <li class="mb-2">
                <a href="#marketingSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="text-white text-decoration-none d-flex align-items-center py-2 px-3 rounded dropdown-toggle">
                    <i class="bi bi-megaphone me-3 fs-5"></i>
                    <span>Marketing</span>
                </a>
                <ul class="collapse list-unstyled ps-4 mt-2" id="marketingSubmenu">
                    <li class="mb-2 {{ request()->routeIs('social_media.index') ? 'active' : '' }}">
                        <a href="{{ route('social_media.index') }}" class="text-white text-decoration-none d-flex align-items-center py-2 px-3 rounded">
                            <i class="bi bi-share me-3 fs-6"></i>
                            <span>Social Media</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('testimonial.index') ? 'active' : '' }}">
                        <a href="{{ route('testimonial.index') }}" class="text-white text-decoration-none d-flex align-items-center py-2 px-3 rounded">
                            <i class="bi bi-chat-square-quote me-3 fs-6"></i>
                            <span>Testimonials</span>
                        </a>
                    </li>
                    <!-- Add YouTube Videos under Marketing -->
                    <li class="{{ request()->routeIs('youtube-videos.*') ? 'active' : '' }}">
                        <a href="{{ route('youtube-videos.index') }}" class="text-white text-decoration-none d-flex align-items-center py-2 px-3 rounded">
                            <i class="bi bi-youtube me-3 fs-6"></i>
                            <span>YouTube Videos</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Messages with Badge -->
            <li class="mb-2 {{ request()->routeIs('messages.index') ? 'active' : '' }}">
                <a href="{{ route('messages.index') }}" class="text-white text-decoration-none d-flex align-items-center justify-content-between py-2 px-3 rounded">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-envelope me-3 fs-5"></i>
                        <span>Messages</span>
                    </div>
                    @if($unreadMessagesCount > 0)
                        <span class="badge bg-danger rounded-pill ms-2" style="font-size: 0.65em;">
                    {{ $unreadMessagesCount > 9 ? '9+' : $unreadMessagesCount }}
                </span>
                    @endif
                </a>
            </li>

            <!-- Information Contact -->
            <li class="mb-2 {{ request()->routeIs('information-contact.index') ? 'active' : '' }}">
                <a href="{{ route('information-contact.index') }}" class="text-white text-decoration-none d-flex align-items-center py-2 px-3 rounded">
                    <i class="bi bi-info-circle me-3 fs-5"></i>
                    <span>Contact Info</span>
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
                                <img src="https://picsum.photos/30" class="rounded-circle border" style="width: 30px; height: 30px;" alt="Profile">
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
    // Collapse behavior for mobile
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarClose = document.getElementById('sidebar-close');
        if (sidebarClose) {
            sidebarClose.addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('d-none');
            });
        }

        // Keep submenus open when their child is active
        document.querySelectorAll('.components li.active').forEach(item => {
            let parentMenu = item.closest('.collapse');
            if (parentMenu) {
                parentMenu.classList.add('show');
            }
        });
    });
</script>

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

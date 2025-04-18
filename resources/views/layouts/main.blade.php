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
<body class="backend-body">
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
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profileSettingsModal"><i class="bi bi-gear"></i> Settings</a></li>
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

<!-- Simplified Profile Settings Modal -->
<div class="modal fade" id="profileSettingsModal" tabindex="-1" aria-labelledby="profileSettingsModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg-4">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileSettingsModalLabel">Account Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Options Selection Screen -->
            <div class="modal-body" id="settingsOptions">
                <div class="row justify-content-center py-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="card h-100 setting-option" id="profileOption">
                            <div class="card-body text-center">
                                <i class="bi bi-person-fill fs-3 mb-3 text-primary"></i>
                                <h5 class="card-title">Update Profile</h5>
                                <p class="card-text text-muted">Change your name and email</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 setting-option" id="passwordOption">
                            <div class="card-body text-center">
                                <i class="bi bi-shield-lock-fill fs-3 mb-3 text-primary"></i>
                                <h5 class="card-title">Change Password</h5>
                                <p class="card-text text-muted">Update your security credentials</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Information Form (Initially Hidden) -->
            <div class="modal-body" id="profileForm" style="display: none;">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-3 text-primary">Update Profile</h5>
                    <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="backToOptions">
                        <i class="bi bi-arrow-left"></i> Back to Options
                    </button>
                </div>
                <form method="POST" action="{{ route('profile.update', auth()->id()) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="update_type" value="profile">

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>

            <!-- Change Password Form (Initially Hidden) -->
            <div class="modal-body" id="passwordForm" style="display: none;">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-3 text-primary">Update Password</h5>
                    <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="backToOptionsPassword">
                        <i class="bi bi-arrow-left"></i> Back to Options
                    </button>
                </div>

                <form method="POST" action="{{ route('profile.update', auth()->id()) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="update_type" value="password">

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                   id="current_password" name="current_password" required>
                            @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                   id="password_confirmation" name="password_confirmation" required>
                            @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5.3 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
{{--SweetAlert--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get elements
        const settingsOptions = document.getElementById('settingsOptions');
        const profileForm = document.getElementById('profileForm');
        const passwordForm = document.getElementById('passwordForm');

        // Toggle functions with animation
        function showProfileForm() {
            settingsOptions.style.opacity = 0;
            setTimeout(() => {
                settingsOptions.style.display = 'none';
                profileForm.style.display = 'block';
                // Trigger animation
                setTimeout(() => {
                    profileForm.classList.add('active');
                }, 50);
            }, 300);
        }

        function showPasswordForm() {
            settingsOptions.style.opacity = 0;
            setTimeout(() => {
                settingsOptions.style.display = 'none';
                passwordForm.style.display = 'block';
                // Trigger animation
                setTimeout(() => {
                    passwordForm.classList.add('active');
                }, 50);
            }, 300);
        }

        function showOptions() {
            // Hide current form
            if (profileForm.style.display === 'block') {
                profileForm.classList.remove('active');
                profileForm.style.opacity = 0;
            } else if (passwordForm.style.display === 'block') {
                passwordForm.classList.remove('active');
                passwordForm.style.opacity = 0;
            }

            setTimeout(() => {
                profileForm.style.display = 'none';
                passwordForm.style.display = 'none';
                settingsOptions.style.display = 'block';
                // Trigger animation
                setTimeout(() => {
                    settingsOptions.style.opacity = 1;
                }, 50);
            }, 300);
        }

        // Event listeners
        document.getElementById('profileOption').addEventListener('click', showProfileForm);
        document.getElementById('passwordOption').addEventListener('click', showPasswordForm);
        document.getElementById('backToOptions').addEventListener('click', showOptions);
        document.getElementById('backToOptionsPassword').addEventListener('click', showOptions);

        // Handle errors and URL parameters
        const urlParams = new URLSearchParams(window.location.search);

        // Show modal if there are errors or URL parameter
        if (document.querySelectorAll('.is-invalid').length > 0 || urlParams.get('openProfileModal') === 'true') {
            const profileModal = new bootstrap.Modal(document.getElementById('profileSettingsModal'));
            profileModal.show();

            // Determine which form to show
            if (document.querySelectorAll('#profileForm .is-invalid').length > 0 || urlParams.get('form') === 'profile') {
                // Small delay to ensure modal is visible first
                setTimeout(showProfileForm, 300);
            } else if (document.querySelectorAll('#passwordForm .is-invalid').length > 0 || urlParams.get('form') === 'password') {
                setTimeout(showPasswordForm, 300);
            }
        }
    });
</script>

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

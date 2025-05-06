<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ff6f00">
    <title>Benevita Consulting</title>
    <!-- Google Fonts - Merriweather -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Link Stylesheet -->
    <link href="{{ asset('assets/css/style.css?v=' . time()) }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>
<body class="preload">

<!-- Navbar -->
<section class="navbar-section">
    <nav class="navbar navbar-expand-lg frontend-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://picsum.photos/30" alt="Logo" width="30"><span style="color: #004a33;"> Benevita</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{route('home')}}" onclick="document.getElementById('navbarNav').classList.remove('show')">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{route('about')}}" onclick="document.getElementById('navbarNav').classList.remove('show')">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('services') ? 'active' : '' }}" href="{{route('services')}}" onclick="document.getElementById('navbarNav').classList.remove('show')">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{route('contact')}}" onclick="document.getElementById('navbarNav').classList.remove('show')">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>

@yield('content')

<!-- Footer -->
<footer class="footer py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-12">
                <div class="row">
                    <!-- Company Info -->
                    <div class="col-md-6">
                        <div class="footer-logo mb-3">
                            <img src="https://picsum.photos/30" alt="Logo">
                            <span>Benevita</span>
                        </div>
                        <p class="mb-3">Membantu bisnis memahami pelanggan lebih baik melalui analisis sentimen berbasis AI.</p>

                        <!-- Dynamic Contact Information -->
                        <div class="contact-info mb-3">
                            <p><i class="fas fa-envelope me-2"></i> {{ $informationContact->email ?? 'info@benevita.com' }}</p>
                            <p><i class="fas fa-phone me-2"></i> {{ $informationContact->phone ?? '+62 123 4567 890' }}</p>
                            <p><i class="fas fa-map-marker-alt me-2"></i> {{ $informationContact->address ?? 'Jl. Contoh No. 123, Yogyakarta' }}</p>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-md-2">
                        <h5 class="mb-3">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{route('home')}}"><i class="fas fa-chevron-right me-2"></i> Home</a></li>
                            <li class="mb-2"><a href="{{route('about')}}"><i class="fas fa-chevron-right me-2"></i> About</a></li>
                            <li class="mb-2"><a href="{{route('services')}}"><i class="fas fa-chevron-right me-2"></i> Services</a></li>
                            <li class="mb-2"><a href="{{route('contact')}}"><i class="fas fa-chevron-right me-2"></i> Contact</a></li>
                        </ul>
                    </div>

                    <!-- Social Media -->
                    <div class="col-md-4">
                        <h5 class="mb-3 text-center">Follow Us</h5>
                        <div class="social-links d-flex justify-content-center flex-wrap gap-3 mb-3">
                            @foreach($social_media as $media)
                                <a href="{{ $media->url }}" target="_blank" class="social-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.1);">
                                    <i class="bi bi-{{ strtolower($media->platform) }} fs-5"></i>
                                </a>
                            @endforeach
                        </div>

                    </div>
                </div>

                <hr class="my-3">

                <div class="copyright text-center">
                    <p class="mb-0">&copy; 2024 Benevita Consulting. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- WhatsApp Container -->
<div class="whatsapp-container">
    @foreach($social_media as $media)
        @if(str_contains(strtolower($media->platform), 'whatsapp'))
            <!-- WhatsApp Card (Collapse) -->
            <div class="collapse" id="whatsappCollapse">
                <div class="card whatsapp-card">
                    <div class="card-header d-flex justify-content-between align-items-center bg-success text-white">
                        <strong>Chat WhatsApp</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-toggle="collapse" data-bs-target="#whatsappCollapse" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
                        <form onsubmit="return sendWhatsAppMessage(this);">
                            <input type="hidden" id="whatsappNumber" value="{{ str_replace(['https://api.whatsapp.com/send?phone='], '', $media->url) }}">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="nama" placeholder="Nama Anda" required>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" id="layanan" required>
                                    <option value="" selected disabled>Pilih Layanan</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->title }}">{{ $service->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" id="pesan" rows="3" placeholder="Pertanyaan tambahan (opsional)"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fab fa-whatsapp me-2"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- WhatsApp Float Button -->
            <button class="whatsapp-float" data-bs-toggle="collapse" data-bs-target="#whatsappCollapse" aria-expanded="false">
                <i class="fab fa-whatsapp"></i>
            </button>
        @endif
    @endforeach
</div>

<script>
    function sendWhatsAppMessage(form) {
        // Get input values
        const name = document.getElementById('nama').value;
        const service = document.getElementById('layanan').value;
        const message = document.getElementById('pesan').value;
        const number = document.getElementById('whatsappNumber').value;

        // Format the message to include the name and selected service
        let fullMessage = "Perkenalkan saya: " + name + "\n\n";
        fullMessage += "Saya tertarik dengan layanan: " + service + "\n\n";

        // Add additional message if provided
        if (message.trim() !== "") {
            fullMessage += "Pertanyaan saya: \n'" + message + "'";
        }

        // Create WhatsApp URL with encoded message
        const whatsappURL = number + "?text=" + encodeURIComponent(fullMessage);

        // Open WhatsApp in new tab
        window.open(whatsappURL, '_blank');

        // Reset the form
        form.reset();

        // Prevent default form submission
        return false;
    }
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset('assets/js/script.js')}}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Logo carousel functionality
        const inner = document.querySelector(".inner");
        if (!inner) return;

        // Store original logos before cloning
        const originalLogos = Array.from(inner.children);
        if (originalLogos.length === 0) return;

        // Function to clone logos
        const cloneLogos = () => {
            originalLogos.forEach(logo => {
                const clone = logo.cloneNode(true);

                // Make sure the clone also triggers the modal
                clone.addEventListener('click', function(event) {
                    pauseAnimation();
                    updateModalWithLogoData(this);
                });

                inner.appendChild(clone);
            });
        };

        // Clone logos until we have enough for smooth scrolling
        const minRequiredWidth = window.innerWidth * 2;
        while (inner.scrollWidth < minRequiredWidth) {
            cloneLogos();
        }

        // Calculate animation duration based on content width
        let duration = Math.max(15, Math.min(inner.scrollWidth / 40, 60));
        inner.style.animationDuration = `${duration}s`;
        inner.classList.add("animated");

        // Animation control functions
        function pauseAnimation() {
            inner.style.animationPlayState = 'paused';
        }

        function resumeAnimation() {
            inner.style.animationPlayState = 'running';
        }

        // Set up modal functionality for all logos (original and cloned)
        const clientModal = document.getElementById('clientModal');
        if (clientModal) {
            const modalInstance = new bootstrap.Modal(clientModal);

            // Add click event to all logo items
            document.querySelectorAll('.logo-item').forEach(item => {
                item.addEventListener('click', function(event) {
                    pauseAnimation();
                    updateModalWithLogoData(this);
                });
            });

            // Resume animation when modal is closed
            clientModal.addEventListener('hidden.bs.modal', function () {
                resumeAnimation();
            });
        }

        // Function to update modal with logo data
        function updateModalWithLogoData(logoElement) {
            const name = logoElement.getAttribute('data-name');
            const description = logoElement.getAttribute('data-description');
            const address = logoElement.getAttribute('data-address');
            const phone = logoElement.getAttribute('data-phone');
            const email = logoElement.getAttribute('data-email');
            const logo = logoElement.getAttribute('data-logo');

            document.getElementById('modalLogo').src = logo;
            document.getElementById('modalName').textContent = name;
            document.getElementById('modalDescription').textContent = description;
            document.getElementById('modalAddress').textContent = address || 'Not provided';
            document.getElementById('modalPhone').textContent = phone || 'Not provided';
            document.getElementById('modalEmail').textContent = email || 'Not provided';
        }
    });

    // Keep your existing scripts for other functionality
    AOS.init();

    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar-section');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
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
            timer: 8000,
            width: '400px',
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
            timer: 8000,
            width: '400px',
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

<!-- Updated Preloader Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if(!sessionStorage.getItem('preloaderShown_v2')) {
            // Create preloader element
            const preloader = document.createElement('div');
            preloader.id = 'preloader';
            preloader.style.position = 'fixed';
            preloader.style.top = '0';
            preloader.style.left = '0';
            preloader.style.width = '100%';
            preloader.style.height = '100%';
            preloader.style.backgroundColor = '#004a33';
            preloader.style.display = 'flex';
            preloader.style.flexDirection = 'column';
            preloader.style.justifyContent = 'center';
            preloader.style.alignItems = 'center';
            preloader.style.zIndex = '9999';
            preloader.style.transition = 'opacity 0.5s ease';

            // Add content to preloader
            preloader.innerHTML = `
                <div style="width: 150px; height: 150px;">
                    <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_raiw2hpe.json" background="transparent" speed="1" loop autoplay></lottie-player>
                </div>
                <div style="color: white; font-size: 1.5rem; font-weight: bold; margin-top: -30px;">Benevita Consulting</div>
            `;

            // Add preloader to body
            document.body.style.overflow = 'hidden'; // Prevent scrolling during preloader
            document.body.prepend(preloader);

            // Mark as shown
            sessionStorage.setItem('preloaderShown_v2', 'true');

            // Remove preloader after delay
            setTimeout(() => {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.remove();
                    document.body.style.overflow = ''; // Re-enable scrolling
                }, 500);
            }, 2000);
        }
    });
</script>
</body>
</html>


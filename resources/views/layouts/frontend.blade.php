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
    <link href="{{asset('assets-fe/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>

<!-- Navbar -->
<section class="navbar-section">
    <nav class="navbar navbar-expand-lg">
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

                        <!-- Added Contact Information -->
                        <div class="contact-info mb-3">
                            <p><i class="fas fa-envelope me-2"></i> info@benevita.com</p>
                            <p><i class="fas fa-phone me-2"></i> +62 123 4567 890</p>
                            <p><i class="fas fa-map-marker-alt me-2"></i> Jl. Contoh No. 123, Yogyakarta</p>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-md-2">
                        <h5 class="mb-3">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{route('home')}}"><i class="fas fa-chevron-right me-2"></i> Home</a></li>
                            <li class="mb-2"><a href="{{route('about')}}"><i class="fas fa-chevron-right me-2"></i> About</a></li>
                            <li class="mb-2"><a href="{{route('services')}}"><i class="fas fa-chevron-right me-2"></i> Services</a></li>
                            <li><a href="{{route('contact')}}"><i class="fas fa-chevron-right me-2"></i> Contact</a></li>
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

<div class="whatsapp-container">
    @foreach($social_media as $media)
        @if(str_contains(strtolower($media->platform), 'whatsapp'))
            <!-- WhatsApp Float Button (Bootstrap Collapse Trigger) -->
            <a class="whatsapp-float" data-bs-toggle="collapse" href="#whatsappCollapse" role="button" aria-expanded="false" aria-controls="whatsappCollapse">
                <i class="fab fa-whatsapp"></i>
            </a>

            <!-- WhatsApp Card (Bootstrap Collapse) -->
            <div class="collapse" id="whatsappCollapse">
                <div class="card border shadow whatsapp-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <strong>Chat WhatsApp</strong>
                        <button type="button" class="btn-close" data-bs-toggle="collapse" data-bs-target="#whatsappCollapse" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
                        <form onsubmit="return sendWhatsAppMessage(this);" target="_blank">
                            <input type="hidden" id="whatsappNumber" value="{{ str_replace(['https://wa.me/', 'https://api.whatsapp.com/send?phone='], '', $media->url) }}">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="nama" placeholder="Nama Anda" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" id="pesan" rows="3" placeholder="Tulis pesanmu di sini..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100" data-bs-toggle="collapse" data-bs-target="#whatsappCollapse">
                                <i class="fab fa-whatsapp"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<script>
    function sendWhatsAppMessage(form) {
        // Get input values
        const name = document.getElementById('nama').value;
        const message = document.getElementById('pesan').value;
        const number = document.getElementById('whatsappNumber').value;

        // Format the message to include the name
        const fullMessage = "Perkenalkan saya: " + name + "\n\n" + "'" + message + "'";

        // Create WhatsApp URL with encoded message
        const whatsappURL = "https://wa.me/" + number + "?text=" + encodeURIComponent(fullMessage);

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
<script src="{{asset('assets-fe/js/script.js')}}"></script>
<script>
    AOS.init();

    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar-section');
        if (window.scrollY > 50) { // Ganti 50 dengan nilai yang sesuai
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    /*Menangani scroll dan collapse navbar*/
    document.addEventListener("DOMContentLoaded", function () {
        let inner = document.querySelector(".inner");
        let logos = Array.from(inner.children);
        let totalLogos = logos.length;

        // Clone terus menerus hingga mencapai panjang yang cukup
        const cloneLogos = () => {
            logos.forEach(logo => {
                let clone = logo.cloneNode(true);
                inner.appendChild(clone);
            });
        };

        // Clone sampai scrollWidth lebih dari dua kali lebar jendela
        while (inner.scrollWidth < window.innerWidth * 2) {
            cloneLogos();
        }

        // Sesuaikan durasi animasi berdasarkan total lebar konten
        let totalWidth = inner.scrollWidth;
        let speed = totalWidth / 50;
        inner.style.animationDuration = `${speed}s`;

        // Tambahkan class untuk memulai animasi
        inner.classList.add("animated");
    });

</script>
</body>
</html>


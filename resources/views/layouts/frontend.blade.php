<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benevita Consulting</title>
    <!-- Google Fonts - Merriweather -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
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
<footer class="footer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-logo">
                            <img src="https://picsum.photos/30" alt="Logo">
                            <span>Benevita</span>
                        </div>
                        <p class="mb-4">Membantu bisnis memahami pelanggan lebih baik melalui analisis sentimen berbasis AI.</p>
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                        src="https://maps.google.com/maps?width=600&amp;height=200&amp;hl=en&amp;q=Universitas Kristen Immanuel Yogyakarta&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{route('home')}}"><i class="fas fa-chevron-right"></i> Home</a></li>
                            <li><a href="{{route('about')}}"><i class="fas fa-chevron-right"></i> About</a></li>
                            <li><a href="{{route('services')}}"><i class="fas fa-chevron-right"></i> Services</a></li>
                            <li><a href="{{route('contact')}}"><i class="fas fa-chevron-right"></i> Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5>Follow Us</h5>
                        <ul class="list-unstyled">
                            <li><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                            <li><a href="#"><i class="fab fa-tiktok"></i> Tiktok</a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i> LinkedIn</a></li>
                        </ul>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-tiktok"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="copyright">
                    <p>&copy; 2024 Benevita Consulting. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

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
</script>
</body>
</html>


@extends('layouts.frontend')

@section('content')

    <!-- Contact Hero Section -->
    <section class="hero-section" id="contact"  style="margin-bottom: 10%;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-12">
                    <div class="row align-items-center flex-column-reverse flex-md-row">
                        <div class="col-md-7 mt-md-0 align-self-center">
                            <h1 class="display-3 fw-normal mb-4" style="color: #0A5640;">Hubungi Kami<br>Kami Siap Membantu</h1>
                            <p class="text-muted mb-4" style="text-align: justify;">
                                Ingin memahami pelanggan lebih dalam dan mengoptimalkan strategi bisnis Anda? Tim BeneVita Consulting siap membantu! Hubungi kami untuk berdiskusi lebih lanjut tentang bagaimana analisis sentimen berbasis AI dan NLP dapat memberikan wawasan berharga bagi bisnis, lembaga, atau organisasi Anda.
                            </p>
                            <p>📩 <span class="fst-italic">Jangan ragu untuk menghubungi kami. Kami siap mendukung perjalanan bisnis Anda!</span></p>
                        </div>
                        <div class="col-md-5 mb-4 align-self-center">
                            <div class="hero-image">
                                <img src="{{asset('assets-fe/images/heros.png')}}" alt="Contact Hero Image" data-aos="zoom-in" data-aos-duration="1500" data-aos-delay="300" class="img-fluid rounded-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Contact -->
    <section class="contact-section p-3" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-12">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <div class="contact-info" data-aos="fade-right" data-aos-duration="1500" style="margin-top: 120px; margin-bottom: 50px;">
                                <h3 class="h4 mb-4">Informasi Kontak</h3>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-map-marker-alt me-3" style="color: #0A5640; font-size: 1.5rem;"></i>
                                    <p class="mb-0">Jl. Ukrim</p>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-phone me-3" style="color: #0A5640; font-size: 1.5rem;"></i>
                                    <p class="mb-0">+62 822 7562 5828</p>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-envelope me-3" style="color: #0A5640; font-size: 1.5rem;"></i>
                                    <p class="mb-0">info@benevitaconsulting.com</p>
                                </div>
                                <div class="social-links mt-4">
                                    <a href="#" class="me-3"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="me-3"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-form" data-aos="fade-left" data-aos-duration="1500">
                                <h2 class="text-center mb-5 display-10 fw-bold" style="color: #0A5640;">Hubungi Kami</h2>
                                <form>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Subjek">
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" rows="5" placeholder="Pesan"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Kirim Pesan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

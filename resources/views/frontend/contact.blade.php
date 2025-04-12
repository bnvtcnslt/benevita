@extends('layouts.frontend')

@section('content')

    <!-- Message Hero Section -->
    <section class="hero-section" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-12">
                    <div class="row align-items-center flex-column-reverse flex-md-row">
                        <div class="col-md-7 mt-md-0 align-self-center">
                            <h1 class="display-3 fw-normal mb-4" style="color: #0A5640;">Hubungi Kami,<br>Kami Siap Membantu</h1>
                            <p class="text-muted mb-4" style="text-align: justify;">
                                Ingin memahami pelanggan lebih dalam dan mengoptimalkan strategi bisnis Anda? Tim BeneVita Consulting siap membantu! Hubungi kami untuk berdiskusi lebih lanjut tentang bagaimana analisis sentimen berbasis AI dan NLP dapat memberikan wawasan berharga bagi bisnis, lembaga, atau organisasi Anda.
                            </p>
                            <p>📩 <span class="fst-italic">Jangan ragu untuk menghubungi kami. Kami siap mendukung perjalanan bisnis Anda!</span></p>
                        </div>
                        <div class="col-md-5 mb-4 align-self-center">
                            <div class="hero-image">
                                <img src="{{asset('assets/images/heros.png')}}" alt="Contact Hero Image" data-aos="zoom-in" data-aos-duration="1500" data-aos-delay="300" class="img-fluid rounded-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Message -->
    <section class="contact-section py-5" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-4">
                        <div class="col-lg-7 col-md-6" style="margin-top: 50px;">
                            <div class="contact-info" data-aos="fade-right" data-aos-duration="1500">
                                <!-- Compact Information Contact -->
                                <div class="contact-details-box bg-white p-3 rounded-3 shadow-sm mb-3">
                                    <h5 class="fw-bold mb-3" style="color: #0A5640;"> Informasi Kontak
                                    </h5>
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="flex-shrink-0 text-success" style="width: 24px;">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <p class="mb-0">
                                                        <a href="mailto:{{ $informationContact->email}}" class="text-decoration-none text-dark">
                                                            {{ $informationContact->email}}
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="flex-shrink-0 text-success" style="width: 24px;">
                                                    <i class="fas fa-phone-alt"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <p class="mb-0 small">
                                                        <a href="tel:{{ $informationContact->phone}}" class="text-decoration-none text-dark">
                                                            {{ $informationContact->phone}}
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="map-container rounded overflow-hidden border" style="height: 300px;">
                                    <iframe
                                        src="https://maps.google.com/maps?width=100%&amp;height=100%&amp;hl=en&amp;q=Universitas%20Kristen%20Immanuel%20Yogyakarta&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                                        frameborder="0"
                                        style="border:0; width: 100%; height: 100%;"
                                        allowfullscreen>
                                    </iframe>
                                </div>

                                <!-- Compact Social Media with Bootstrap Icons -->
                                <div class="social-media-box bg-white p-2 rounded-3 shadow-sm mt-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        @foreach($social_media as $media)
                                            <a href="{{ $media->url }}" target="_blank" class="text-success fs-6">
                                                <i class="bi bi-{{ strtolower($media->platform) }}"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Column -->
                        <div class="col-lg-5 col-md-6">
                            <div class="contact-form" data-aos="fade-left" data-aos-duration="1500">
                                <h2 class="mb-4 fw-bold text-center" style="color: #0A5640;">Hubungi Kami</h2>
                                <form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" name="full_name" class="form-control" placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="tel" name="phone" class="form-control" placeholder="Nomor Whatsapp" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="company" class="form-control" placeholder="Nama Perusahaan/Organisasi">
                                    </div>
                                    <div class="mb-3">
                                        <select name="subject" class="form-select" required>
                                            <option value="" selected disabled>Pilih Layanan</option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->title }}">{{ $service->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <select name="referral_source" class="form-select">
                                            <option value="" selected disabled>Bagaimana Anda mengetahui kami?</option>
                                            <option value="search">Mesin Pencari (Google, dll)</option>
                                            <option value="social_media">Media Sosial</option>
                                            <option value="referral">Rekomendasi Kolega/Teman</option>
                                            <option value="advertisement">Iklan</option>
                                            <option value="event">Seminar/Event</option>
                                            <option value="other">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <textarea name="message" class="form-control" rows="5" placeholder="Pesan tambahan (opsional)"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">Kirim Pesan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

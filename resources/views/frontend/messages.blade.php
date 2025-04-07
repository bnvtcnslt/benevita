@extends('layouts.frontend')

@section('content')

    <!-- Message Hero Section -->
    <section class="hero-section" id="contact"  style="margin-bottom: 10%;">
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
                        <div class="col-lg-7 col-md-6">
                            <div class="contact-info h-80" data-aos="fade-right" data-aos-duration="1500">
                                <div class="map-container rounded overflow-hidden">
                                    <iframe
                                        src="https://maps.google.com/maps?width=100%&amp;height=100%&amp;hl=en&amp;q=Universitas%20Kristen%20Immanuel%20Yogyakarta&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                                        frameborder="0"
                                        style="border:0; width: 100%; height: 400px;"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>

                        <!-- Form Column -->
                        <div class="col-lg-5 col-md-6">
                            <div class="contact-form" data-aos="fade-left" data-aos-duration="1500">
                                <h2 class="mb-4 fw-bold text-center" style="color: #0A5640;">Hubungi Kami</h2>
                                <form action="{{ route('messages.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" name="full_name" class="form-control" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="subject" class="form-control" placeholder="Subjek (Opsional)">
                                    </div>
                                    <div class="mb-3">
                                        <textarea name="message" class="form-control" rows="5" placeholder="Pesan"></textarea>
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

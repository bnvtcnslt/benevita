@extends('layouts.frontend')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-12">
                    <div class="row align-items-center flex-column-reverse flex-md-row">
                        <div class="col-md-7 mt-md-0 align-self-center">
                            <h1 class="display-3 fw-normal mb-4" style="color: #0A5640;">Memahami<br>Pelanggan,<br>Mengoptimalkan<br>Strategi
                            </h1>
                            <p class="text-muted mb-4" style="text-align: justify;">
                                BeneVita Consulting membantu bisnis, lembaga, dan organisasi memahami opini pelanggan
                                dengan analisis sentimen berbasis NLP dan AI. Dengan wawasan mendalam dari data ulasan,
                                media sosial, dan survei, Kami tidak hanya mengukur sentimen, tetapi juga
                                mengidentifikasi aspek yang memengaruhi opini pelanggan. sehingga membantu Anda
                                mengambil keputusan strategis yang lebih cerdas.</p>
                            <p>🔍 <span
                                    class="fst-italic">Siap memahami pelanggan lebih baik? Hubungi kami sekarang!</span>
                            </p>
                        </div>
                        <div class="col-md-5 mb-4 align-self-center">
                            <div class="hero-image">
                                <img src="{{asset('assets-fe/images/heros.png')}}" alt="Hero Image" data-aos="zoom-in"
                                     data-aos-duration="1500" data-aos-delay="300" class="img-fluid rounded-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="services">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-12">
                    <h2 class="text-center mb-5 display-6 fw-bold" style="color: #0A5640;">Our Services</h2>
                    <div class="services-wrapper">
                        <div class="services">
                            <img src="{{asset('assets-fe/images/services.webp')}}" alt="Service Image">
                            <h3>Analisis Sentimen</h3>
                            <p>Layanan analisis sentimen kami membantu Anda memahami emosi dan opini pelanggan melalui data tekstual...</p>
                            <a href="#" class="read-services" data-bs-toggle="modal" data-bs-target="#servicesmodal">
                                Read More <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="services">
                            <img src="{{asset('assets-fe/images/services.webp')}}" alt="Service Image">
                            <h3>Analisis Aspek Sentimen</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</p>
                            <a href="#" class="read-services" data-bs-toggle="modal" data-bs-target="#servicesmodal">
                                Read More <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="services">
                            <img src="{{asset('assets-fe/images/services.webp')}}" alt="Service Image">
                            <h3>Pemantauan Opini Publik dan Analisis Kompetitif</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</p>
                            <a href="#" class="read-services" data-bs-toggle="modal" data-bs-target="#servicesmodal">
                                Read More <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Logo section -->
    <section class="logo-section" id="logo" style="margin-top: 2%;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-12">
                    <div class="logo-section">
                        <h2 class="text-center mb-5 display-6 fw-bold" style="color: #0A5640;">Our Client</h2>
                        <div class="tag-list">
                            <div class="inner">
                                @foreach($clients as $client)
                                    <img src="{{ Storage::url('/clients/' . $client->logo_img) }}" alt="Client Logo">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section py-5" id="testimonials" style="margin-top: 4%;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-12">
                    <h2 class="text-center mb-5 display-6 fw-bold" style="color: #0A5640;">What Our Clients Say</h2>

                    <div class="testimonial-carousel">
                        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
                            <div class="carousel-inner">
                                @php
                                    $chunks = $featuredTestimonials->chunk(2);
                                @endphp

                                @foreach($chunks as $index => $chunk)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <div class="row {{ $chunk->count() == 1 ? 'justify-content-center' : '' }}">
                                            @foreach($chunk as $testimonial)
                                                <div class="col-md-6 mb-4 d-flex">
                                                    <div class="card border-0 shadow-sm w-100" style="height: 350px;">
                                                        <div class="card-body d-flex flex-column">
                                                            <div class="text-center mb-3">
                                                                @if($testimonial->image)
                                                                    <img src="{{ Storage::url('testimonials/' . $testimonial->image) }}"
                                                                         alt="{{ optional($testimonial->client)->name ?? 'Client' }}"
                                                                         class="rounded-circle"
                                                                         width="80"
                                                                         height="80"
                                                                         style="object-fit: cover">
                                                                @else
                                                                    <img src="{{ asset('assets-fe/images/placeholder.jpg') }}"
                                                                         alt="{{ optional($testimonial->client)->name ?? 'Client' }}"
                                                                         class="rounded-circle"
                                                                         width="80"
                                                                         height="80">
                                                                @endif

                                                                <div class="mb-2 mt-3">
                                                                    @for($i = 1; $i <= 5; $i++)
                                                                        @if($i <= $testimonial->rating)
                                                                            <i class="fas fa-star text-warning"></i>
                                                                        @else
                                                                            <i class="far fa-star text-warning"></i>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            </div>

                                                            <div class="testimonial-text-container flex-grow-1 d-flex align-items-center justify-content-center">
                                                                <p class="text-muted" style="text-align: center; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical;">
                                                                    "{{ \Illuminate\Support\Str::limit($testimonial->testimonial_text, 150) }}"
                                                                </p>
                                                            </div>

                                                            <div class="text-center mt-auto">
                                                                <h5 class="mb-1">{{ optional($testimonial->client)->name ?? 'Client' }}</h5>
                                                                @if($testimonial->position)
                                                                    <p class="small text-muted mb-0">{{ $testimonial->position }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if($chunks->count() > 1)
                                <div class="carousel-indicators position-static mt-3">
                                    @foreach($chunks as $index => $chunk)
                                        <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="{{ $index }}"
                                                class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                                aria-label="Slide {{ $index + 1 }}" style="background-color: #0A5640;"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Contact -->
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
                                <form>
                                    <div class="mb-3">
                                        <input type="text" class="form-control py-2" placeholder="Nama Lengkap" style="border: 1px solid #ced4da;">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control py-2" placeholder="Email" style="border: 1px solid #ced4da;">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control py-2" placeholder="Subjek (Opsional)" style="border: 1px solid #ced4da;">
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" rows="5" placeholder="Pesan" style="border: 1px solid #ced4da;"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100 py-2 fw-bold">Kirim Pesan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="servicesmodal" tabindex="-1" role="dialog" aria-labelledby="servicesmodalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-image-container position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2 bg-white"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    <img src="{{asset('assets-fe/images/services.webp')}}" alt="Service Image" class="w-100">
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis asperiores unde quia
                    saepe veritatis id molestias eligendi ratione repudiandae incidunt assumenda natus animi sunt
                    commodi, adipisci vitae rerum porro est?
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis praesentium vitae et, excepturi
                    amet ut minima rerum architecto quae
                    iusto eveniet nisi doloribus adipisci vero, reprehenderit atque ipsum perferendis neque!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis asperiores unde quia
                    saepe veritatis id molestias eligendi ratione repudiandae incidunt assumenda natus animi sunt
                    commodi, adipisci vitae rerum porro est?
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis praesentium vitae et, excepturi
                    amet ut minima rerum architecto quae
                    iusto eveniet nisi doloribus adipisci vero, reprehenderit atque ipsum perferendis neque!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis asperiores unde quia
                    saepe veritatis id molestias eligendi ratione repudiandae incidunt assumenda natus animi sunt
                    commodi, adipisci vitae rerum porro est?
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis praesentium vitae et, excepturi
                    amet ut minima rerum architecto quae
                    iusto eveniet nisi doloribus adipisci vero, reprehenderit atque ipsum perferendis neque!
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.frontend')

@section('content')

    <!-- Services Hero Section -->
    <section class="hero-section" id="home" style="padding-bottom: 5%;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-12">
                    <div class="row align-items-center flex-column-reverse flex-md-row">
                        <div class="col-md-7 mt-md-0 align-self-center">
                            <h1 class="display-3 fw-normal mb-4" style="color: #0A5640;">Mengubah Wawasan Menjadi Tindakan</h1>
                            <p class="text-muted mb-4" style="text-align: justify;">
                                Di BeneVita Consulting, kami membantu bisnis memanfaatkan kekuatan umpan balik pelanggan melalui analisis sentimen yang canggih. Keahlian kami dalam NLP dan AI memungkinkan Anda mendapatkan wawasan yang dapat ditindaklanjuti dari ulasan, media sosial, dan survei, mendorong keputusan strategis yang meningkatkan kepuasan serta loyalitas pelanggan.
                            </p>
                            <p>💡 <span class="fst-italic">Temukan solusi terbaik untuk bisnis Anda dengan layanan analisis sentimen kami. Mari bersama-sama mengoptimalkan strategi dan meningkatkan pengalaman pelanggan!</span></p>
                        </div>
                        <div class="col-md-5 mb-4 align-self-center">
                            <div class="hero-image">
                                <img src="{{asset('assets/images/heros.png')}}" alt="Hero Image" data-aos="zoom-in" data-aos-duration="1500" data-aos-delay="300" class="img-fluid rounded-4">
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
            <div class="row justify-content-center" data-aos="fade-up" data-aos-duration="1500">
                <div class="col-12">
                    <h2 class="text-center mb-5 display-6 fw-bold" style="color: #0A5640;">Our Services</h2>
                    <div class="services-grid">
                        @foreach($services as $service)
                            <div class="service-card" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
                                @if($service->image)
                                    <img src="{{ Storage::url('services/' . $service->image) }}" alt="{{ $service->title }}">
                                @else
                                    <img src="{{ asset('assets/images/services.webp') }}" alt="{{ $service->title }}">
                                @endif
                                <h3>{{ $service->title }}</h3>
                                <p class="service-description">{{ \Illuminate\Support\Str::limit($service->description, 120) }}</p>
                                <a href="#" class="read-services" data-bs-toggle="modal" data-bs-target="#serviceModal{{ $service->id }}">
                                    Read More <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Modals -->
    @foreach($services as $service)
        <div class="modal fade" id="serviceModal{{ $service->id }}" tabindex="-1" aria-labelledby="serviceModalLabel{{ $service->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="serviceModalLabel{{ $service->id }}">{{ $service->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if($service->image)
                            <img src="{{ Storage::url('services/' . $service->image) }}" alt="{{ $service->title }}" class="img-fluid mb-3" style="width: 100%; border-radius: 8px;">
                        @else
                            <img src="{{ asset('assets/images/services.webp') }}" alt="{{ $service->title }}" class="img-fluid mb-3" style="width: 100%; border-radius: 8px;">
                        @endif
                        <p>{{ $service->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Logo section -->
    <section class="logo-section" id="logo" style="margin-top: 2%;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-12">
                    <div class="logo-section">
                        <h2 class="text-center mb-5 display-6 fw-bold" style="color: #0A5640;">Our Client</h2>
                        <div class="tag-list" id="clientLogos">
                            <div class="inner" id="logoContainer">
                                @foreach($clients as $client)
                                    <div class="logo-item"
                                         data-bs-toggle="modal"
                                         data-bs-target="#clientModal"
                                         data-name="{{ $client->name }}"
                                         data-description="{{ $client->description }}"
                                         data-address="{{ $client->address }}"
                                         data-phone="{{ $client->phone }}"
                                         data-email="{{ $client->email }}"
                                         data-logo="{{ Storage::url('/clients/' . $client->logo_img) }}">
                                        <img src="{{ Storage::url('/clients/' . $client->logo_img) }}" alt="{{ $client->name }} Logo">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Client Description Modal -->
                        <div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="clientModalLabel">Client Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center mb-4">
                                            <img id="modalLogo" src="" alt="Client Logo" class="img-fluid mb-3" style="max-height: 100px;">
                                            <h4 id="modalName" class="fw-bold" style="color: #0A5640;"></h4>
                                        </div>
                                        <div class="client-info">
                                            <p id="modalDescription" class="mb-3"></p>
                                            <div class="client-contact mt-4">
                                                <p><i class="fas fa-map-marker-alt me-2" style="color: #0A5640;"></i> <span id="modalAddress"></span></p>
                                                <p><i class="fas fa-phone me-2" style="color: #0A5640;"></i> <span id="modalPhone"></span></p>
                                                <p><i class="fas fa-envelope me-2" style="color: #0A5640;"></i> <span id="modalEmail"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section py-5" id="testimonials" style="margin-top: 4%;" data-aos="fade-up" data-aos-duration="1500">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-12">
                    <h2 class="text-center mb-5 display-6 fw-bold" style="color: #0A5640;" data-aos="fade-up" data-aos-duration="1500">What Our Clients Say</h2>

                    <div class="testimonial-carousel">
                        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000" data-aos="fade-up" data-aos-duration="1500">
                            <div class="carousel-inner">
                                @foreach($featuredTestimonials as $testimonial)
                                    @php
                                        $chunks = $featuredTestimonials->chunk(2);
                                    @endphp
                                @endforeach

                                @foreach($chunks as $index => $chunk)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <div class="row {{ $chunk->count() == 1 ? 'justify-content-center' : '' }}">
                                            @foreach($chunk as $testimonial)
                                                <div class="col-md-6 mb-4 d-flex" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
                                                    <div class="card border-0 shadow-sm w-100">
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
                                                                    <img src="{{ asset('assets/images/placeholder.jpg') }}"
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
@endsection

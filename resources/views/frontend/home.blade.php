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
                            <p>🌟 <span
                                    class="fst-italic">Siap memahami pelanggan lebih baik? Hubungi kami sekarang!</span>
                            </p>
                        </div>
                        <div class="col-md-5 mb-4 align-self-center">
                            <div class="hero-image">
                                <img src="{{asset('assets/images/heros.png')}}" alt="Hero Image" data-aos="zoom-in"
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

    @php
        $videos = App\Models\YoutubeVideo::where('is_active', true)->get();
        $youtubeChannel = null;

        foreach ($videos as $video) {
            if (!empty($video->channel_url)) {
                $youtubeChannel = $video->channel_url;
                break;
            }
        }
    @endphp

    @if($videos->count() > 0)
        <section class="youtube-video-section py-5">
            <div class="container">
                @foreach($videos as $video)
                    <!-- Video Item -->
                    <div class="row youtube-video-row align-items-center mb-5 {{ $video->position_right ? 'flex-lg-row-reverse' : '' }}">
                        <!-- Video Column -->
                        <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-{{ $video->position_right ? 'left' : 'right' }}" data-aos-duration="1000">
                            <div class="video-container">
                                <iframe
                                    class="youtube-iframe"
                                    src="https://www.youtube.com/embed/{{ $video->video_id }}"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>

                        <!-- Content Column -->
                        <div class="col-lg-6" data-aos="fade-{{ $video->position_right ? 'right' : 'left' }}" data-aos-duration="1000" data-aos-delay="200">
                            <div class="video-content">
                                <h3 class="video-title">{{ $video->title }}</h3>
                                <div class="divider mb-3"></div>
                                <p class="video-description">
                                    {{ $video->description }}
                                </p>
                                {{--<a href="{{ $video->url }}" target="_blank" class="btn btn-primary mt-3">
                                    <i class="fab fa-youtube me-2"></i>Tonton di YouTube
                                </a>--}}
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Button to YouTube Channel -->
                @if($youtubeChannel)
                <div class="row mt-5">
                    <div class="col-12 text-center" data-aos="fade-up" data-aos-duration="1000">
                        <a href="{{ $youtubeChannel }}" target="_blank" class="btn btn-outline-primary">
                            <i class="fab fa-youtube me-2"></i>Kunjungi Channel YouTube Kami
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </section>
    @endif

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

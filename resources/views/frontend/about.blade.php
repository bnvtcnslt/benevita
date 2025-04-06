@extends('layouts.frontend')

@section('content')

<!-- About Hero Section -->
<section class="hero-section" id="about-hero" style="padding-bottom: 10%;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-12">
                <div class="row align-items-center flex-column-reverse flex-md-row">
                    <div class="col-md-7 mt-md-0 align-self-center">
                        <h1 class="display-3 fw-normal mb-4" style="color: #0A5640;">Menyediakan perawatan terbaik <br> sejak 2025</h1>
                        <p class="text-muted mb-4" style="text-align: justify;">
                            BeneVita Consulting adalah perusahaan konsultan yang berfokus pada analisis sentimen dan pemahaman pelanggan. Kami menggunakan teknologi NLP (Natural Language Processing) dan AI untuk membantu bisnis memahami feedback pelanggan mereka dengan lebih baik.</p>
                        <p>🚀 <span class="fst-italic">Bersama BeneVita Consulting, ubah data menjadi wawasan yang berharga dan optimalkan pertumbuhan bisnis Anda!</span></p>
                    </div>
                    <div class="col-md-5 mb-4 align-self-center">
                        <div class="hero-image">
                            <img src="{{asset('assets-fe/images/about.png')}}" alt="About Hero Image" data-aos="zoom-in" data-aos-duration="1500" data-aos-delay="300" class="img-fluid rounded-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section" id="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-12">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="about-image" data-aos="fade-right" data-aos-duration="1500" data-aos-delay="300">
                            <img src="{{asset('assets-fe/images/about.png')}}" alt="About Image" class="img-fluid rounded-4" style="width: 90%;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-content" data-aos="fade-left" data-aos-duration="1500" data-aos-delay="300">
                            <h2 class="display-6 fw-bold mb-4" style="color: #0A5640;">Tentang Kami</h2>
                            <p class="text-muted mb-4">BeneVita Consulting adalah perusahaan konsultan yang berfokus pada analisis sentimen dan pemahaman pelanggan. Kami menggunakan teknologi NLP (Natural Language Processing) dan AI untuk membantu bisnis memahami feedback pelanggan mereka dengan lebih baik.</p>
                            <div class="row g-4 mb-4">
                                <div class="col-6">
                                    <div class="about-feature">
                                        <i class="fas fa-chart-line mb-3" style="color: #0A5640; font-size: 2rem;"></i>
                                        <h5 class="mb-2">Analisis Akurat</h5>
                                        <p class="small text-muted">Hasil analisis yang tepat dan dapat diandalkan</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="about-feature">
                                        <i class="fas fa-users mb-3" style="color: #0A5640; font-size: 2rem;"></i>
                                        <h5 class="mb-2">Tim Ahli</h5>
                                        <p class="small text-muted">Didukung oleh tim profesional berpengalaman</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="about-feature">
                                        <i class="fas fa-clock mb-3" style="color: #0A5640; font-size: 2rem;"></i>
                                        <h5 class="mb-2">Real-time</h5>
                                        <p class="small text-muted">Monitoring dan analisis secara real-time</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="about-feature">
                                        <i class="fas fa-shield-alt mb-3" style="color: #0A5640; font-size: 2rem;"></i>
                                        <h5 class="mb-2">Keamanan Data</h5>
                                        <p class="small text-muted">Perlindungan data yang terjamin</p>
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

<!-- Our Team Section -->
<section class="team-section" id="our-team">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-12">
                <h2 class="text-center mb-5 display-6 fw-bold" style="color: #0A5640;">Our Team</h2>
                <div class="services-wrapper">
                    <div class="image-container">
                        @foreach($members as $member)
                            <div class="services text-center" style="max-width:100%" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
                                <img src="{{ Storage::url('teams/' . $member->image) }}" alt="{{ $member->name }}" class="img-fluid rounded-3" style="width: 100%; height: 200px; object-fit: cover;">
                                <h3 class="mt-3" style="font-size: 1.2rem">{{ $member->name }}</h3>
                                <p class="small text-muted text-center" style="font-size: .9rem">
                                    {{ $member->team ? $member->team->name : 'No Team' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

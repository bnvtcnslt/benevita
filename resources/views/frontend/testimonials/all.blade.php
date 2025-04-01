@extends('layouts.frontend')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="mb-5 text-center display-6 fw-bold" style="color: #0A5640;">All Client Testimonials</h1>

                <div class="row">
                    @forelse($testimonials as $testimonial)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card border-0 shadow-sm h-100">
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
                                            <img src="{{ asset('assets-fe/images/placeholder.png') }}"
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

                                    <p class="text-muted flex-grow-1" style="text-align: center;">
                                        "{{ \Illuminate\Support\Str::limit($testimonial->testimonial_text, 200) }}"
                                    </p>

                                    <div class="text-center mt-3">
                                        <h5 class="mb-1">{{ optional($testimonial->client)->name ?? 'Client' }}</h5>
                                        @if($testimonial->position)
                                            <p class="small text-muted mb-0">{{ $testimonial->position }}</p>
                                        @endif
                                        <p class="small text-muted mt-2">
                                            {{ $testimonial->created_at->format('F j, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">No testimonials available yet.</div>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
@endsection

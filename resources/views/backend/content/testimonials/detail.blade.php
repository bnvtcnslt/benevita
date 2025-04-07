@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold">Testimonial Details</h4>
                        <a href="{{ route('testimonial.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Back to List
                        </a>
                    </div>

                    <div class="row">
                        <!-- Left Column - Testimonial Info -->
                        <div class="col-lg-8">
                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-3">Testimonial Information</h5>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>ID:</strong></p>
                                            <p>{{ $testimonials->id }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Status:</strong></p>
                                            <span class="badge {{ $testimonials->status ? 'bg-success' : 'bg-danger' }}">
                                                {{ $testimonials->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Client:</strong></p>
                                            <p>{{ $testimonials->client->name }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Position:</strong></p>
                                            <p>{{ $testimonials->position ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <p class="mb-1"><strong>Rating:</strong></p>
                                        <div>
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $testimonials->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-warning"></i>
                                                @endif
                                            @endfor
                                            ({{ $testimonials->rating }}/5)
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <p class="mb-1"><strong>Display Order:</strong></p>
                                        <p>{{ $testimonials->order }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <p class="mb-1"><strong>Testimonial Text:</strong></p>
                                        <div class="border p-3 rounded bg-light">
                                            "{{ $testimonials->testimonial_text }}"
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Client Photo & Actions -->
                        <div class="col-lg-4">
                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold mb-3">Client Photo</h5>

                                    @if($testimonials->image)
                                        <img src="{{ Storage::url('testimonials/' . $testimonials->image) }}"
                                             alt="{{ $testimonials->client->name }}"
                                             class="img-fluid rounded-circle mb-3"
                                             style="width: 200px; height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                             style="width: 200px; height: 200px; margin: 0 auto;">
                                            <i class="bi bi-person-fill" style="font-size: 3rem;"></i>
                                        </div>
                                        <p>No photo available</p>
                                    @endif
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-3">Actions</h5>

                                    <div class="d-grid gap-2">
                                        <a href="#" class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#updateModal{{$testimonials->id}}">
                                            <i class="bi bi-pencil-square me-1"></i> Edit Testimonial
                                        </a>

                                        <form action="{{ route('testimonial.destroy', $testimonials->id) }}" method="POST" class="d-grid">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{$testimonials->id}})" class="btn btn-danger">
                                                <i class="bi bi-trash me-1"></i> Delete Testimonial
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal (Same as in your index view) -->
    <div class="modal fade" id="updateModal{{$testimonials->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Testimonial</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('testimonial.update', $testimonials->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="client_id" class="form-label">Client</label>
                            <select class="form-select" id="client_id" name="client_id" required>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ $testimonials->client_id == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" name="position" value="{{ $testimonials->position }}">
                        </div>
                        <div class="mb-3">
                            <label for="testimonial_text" class="form-label">Testimonial</label>
                            <textarea class="form-control" name="testimonial_text" rows="3" required>{{ $testimonials->testimonial_text }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating (1-5)</label>
                            <select class="form-select" name="rating" required>
                                <option value="5" {{ $testimonials->rating == 5 ? 'selected' : '' }}>5 - Excellent</option>
                                <option value="4" {{ $testimonials->rating == 4 ? 'selected' : '' }}>4 - Very Good</option>
                                <option value="3" {{ $testimonials->rating == 3 ? 'selected' : '' }}>3 - Good</option>
                                <option value="2" {{ $testimonials->rating == 2 ? 'selected' : '' }}>2 - Fair</option>
                                <option value="1" {{ $testimonials->rating == 1 ? 'selected' : '' }}>1 - Poor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <div class="row">
                                <div class="col-lg-2 col-md-12 col-12">
                                    @if($testimonials->image)
                                        <img src="{{ Storage::url('testimonials/' . $testimonials->image) }}" alt="Testimonial" width="50px" height="50px" class="rounded-circle">
                                    @else
                                        <span>No image</span>
                                    @endif
                                </div>
                                <div class="col-lg-10 col-md-12 col-12">
                                    <input type="file" class="form-control mt-2" name="image">
                                    <small class="form-text text-muted">Leave empty to keep current image</small>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control" id="status" required>
                                <option value="1" {{ $testimonials->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $testimonials->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="order" class="form-label">Urutan</label>
                            <select class="form-select" name="order" required>
                                @for($i = 1; $i <= $maxOrder; $i++)
                                    <option value="{{ $i }}" {{ $testimonials->order == $i ? 'selected' : '' }}>
                                        Posisi ke-{{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your testimonial has been deleted.",
                        icon: "success"
                    }).then(()=>{
                        document.getElementById('delete-testimonial-' + id).submit();
                    });
                }
            });
        }
    </script>
@endsection

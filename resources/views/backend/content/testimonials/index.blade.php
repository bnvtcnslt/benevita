@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="fw-bold">Testimonial List</h4>
                    <!-- Testimonials - Search and Add Button -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
                        <!-- Search Form - Full width on mobile -->
                        <div class="col-12 col-md-5 col-lg-4 px-0">
                            <form action="{{ route('testimonial.search') }}" method="GET">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="query" class="form-control" placeholder="Search for testimonials..." value="{{ request()->input('query') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Add Button - Full width on mobile -->
                        <div class="col-12 col-md-auto px-0 mt-2 mt-md-0">
                            <button class="btn btn-primary d-flex align-items-center justify-content-center w-100"
                                    data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="bi bi-plus-lg me-1"></i>
                                <span>Add Testimonial</span>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center align-middle">
                            <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Position</th>
                                <th>Testimonial</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($testimonials as $testimonial)
                                <tr>
                                    <td>{{ ($testimonials->currentPage() - 1) * $testimonials->perPage() + $loop->iteration }}</td>
                                    <td>{{ $testimonial->id }}</td>
                                    <td>{{ $testimonial->client->name }}</td>
                                    <td>{{ $testimonial->position ?? '-' }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($testimonial->testimonial_text, 50) }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-center">
                                            @if($testimonial->image)
                                                <img src="{{ Storage::url('testimonials/' . $testimonial->image) }}"
                                                     alt="Testimonial"
                                                     class="rounded-circle"
                                                     width="50"
                                                     height="50"
                                                     style="object-fit: cover">
                                            @else
                                                <span>No image</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $testimonial->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $testimonial->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('testimonial.show', $testimonial->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{$testimonial->id}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form id="delete-testimonial-{{$testimonial->id}}" action="{{route('testimonial.destroy', $testimonial->id)}}" method="post" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a onclick="confirmDelete({{$testimonial->id}})" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <!-- Previous Page Link -->
                            <li class="page-item {{ $testimonials->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $testimonials->previousPageUrl() }}" aria-label="Previous">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>

                            @php
                                $currentPage = $testimonials->currentPage();
                                $lastPage = $testimonials->lastPage();
                                $start = max($currentPage - 2, 1);
                                $end = min($currentPage + 2, $lastPage);

                                if ($start > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="' . $testimonials->url(1) . '">1</a></li>';
                                    if ($start > 2) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                }

                                for ($i = $start; $i <= $end; $i++) {
                                    $active = $currentPage == $i ? 'active' : '';
                                    echo '<li class="page-item ' . $active . '"><a class="page-link" href="' . $testimonials->url($i) . '">' . $i . '</a></li>';
                                }

                                if ($end < $lastPage) {
                                    if ($end < $lastPage - 1) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                    echo '<li class="page-item"><a class="page-link" href="' . $testimonials->url($lastPage) . '">' . $lastPage . '</a></li>';
                                }
                            @endphp

                            <li class="page-item {{ $testimonials->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $testimonials->nextPageUrl() }}" aria-label="Next">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Testimonial</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('testimonial.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="client_id" class="form-label">Client</label>
                            <select class="form-select" id="client_id" name="client_id" required>
                                <option value="">Select Client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" name="position" placeholder="Position (e.g. CEO, Marketing Director)">
                        </div>
                        <div class="mb-3">
                            <label for="testimonial_text" class="form-label">Testimonial</label>
                            <textarea class="form-control" name="testimonial_text" rows="3" placeholder="Testimonial text" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating (1-5)</label>
                            <select class="form-select" id="rating" name="rating" required>
                                <option value="5">5 - Excellent</option>
                                <option value="4">4 - Very Good</option>
                                <option value="3">3 - Good</option>
                                <option value="2">2 - Fair</option>
                                <option value="1">1 - Poor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <small class="form-text text-muted">Person's photo (optional)</small>
                        </div>
                        <div class="mb-3">
                            <label for="order" class="form-label">Urutan</label>
                            <select class="form-select" name="order" required>
                                @for($i = 1; $i <= $maxOrder; $i++)
                                    <option value="{{ $i }}" {{ $i == $maxOrder ? 'selected' : '' }}>
                                        Posisi ke-{{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach($testimonials as $testimonial)
        <!-- Modal Update -->
        <div class="modal fade" id="updateModal{{$testimonial->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Edit Testimonial</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('testimonial.update', $testimonial->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="client_id" class="form-label">Client</label>
                                <select class="form-select" id="client_id" name="client_id" required>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ $testimonial->client_id == $client->id ? 'selected' : '' }}>
                                            {{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control" name="position" value="{{ $testimonial->position }}">
                            </div>
                            <div class="mb-3">
                                <label for="testimonial_text" class="form-label">Testimonial</label>
                                <textarea class="form-control" name="testimonial_text" rows="3" required>{{ $testimonial->testimonial_text }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating (1-5)</label>
                                <select class="form-select" name="rating" required>
                                    <option value="5" {{ $testimonial->rating == 5 ? 'selected' : '' }}>5 - Excellent</option>
                                    <option value="4" {{ $testimonial->rating == 4 ? 'selected' : '' }}>4 - Very Good</option>
                                    <option value="3" {{ $testimonial->rating == 3 ? 'selected' : '' }}>3 - Good</option>
                                    <option value="2" {{ $testimonial->rating == 2 ? 'selected' : '' }}>2 - Fair</option>
                                    <option value="1" {{ $testimonial->rating == 1 ? 'selected' : '' }}>1 - Poor</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <div class="row">
                                    <div class="col-lg-2 col-md-12 col-12">
                                        @if($testimonial->image)
                                            <img src="{{ Storage::url('testimonials/' . $testimonial->image) }}" alt="Testimonial" width="50px" height="50px" class="rounded-circle">
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
                                    <option value="1" {{ $testimonial->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $testimonial->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="order" class="form-label">Urutan</label>
                                <select class="form-select" name="order" required>
                                    @for($i = 1; $i <= $testimonials->total(); $i++)
                                        <option value="{{ $i }}" {{ $testimonial->order == $i ? 'selected' : '' }}>
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
    @endforeach

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

@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold">Service Details</h4>
                        <a href="{{ route('service.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Back to List
                        </a>
                    </div>

                    <div class="row">
                        <!-- Left Column - Service Info -->
                        <div class="col-lg-8">
                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-3">Service Information</h5>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>ID:</strong></p>
                                            <p>{{ $service->id }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Date Added:</strong></p>
                                            <p>{{ $service->created_at ? $service->created_at->format('d M Y') : 'Not available' }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Title:</strong></p>
                                            <p>{{ $service->title }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Assigned Team:</strong></p>
                                            <p>{{ $service->team ? $service->team->name : 'Not assigned' }}</p>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <p class="mb-1"><strong>Description:</strong></p>
                                        <div class="border p-3 rounded bg-light">
                                            {{ $service->description ?? 'No description available' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Service Image & Actions -->
                        <div class="col-lg-4">
                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold mb-3">Service Image</h5>

                                    @if($service->image)
                                        <img src="{{ Storage::url('services/' . $service->image) }}"
                                             alt="{{ $service->title }}"
                                             class="img-fluid rounded mb-3"
                                             style="width: 100%; max-height: 300px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                                             style="width: 100%; height: 200px;">
                                            <i class="bi bi-image" style="font-size: 3rem;"></i>
                                        </div>
                                        <p>No image available</p>
                                    @endif
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-3">Actions</h5>

                                    <div class="d-grid gap-2">
                                        <a href="#" class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#updateModal{{$service->id}}">
                                            <i class="bi bi-pencil-square me-1"></i> Edit Service
                                        </a>

                                        <form action="{{ route('service.destroy', $service->id) }}" method="POST" class="d-grid">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{$service->id}})" class="btn btn-danger">
                                                <i class="bi bi-trash me-1"></i> Delete Service
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

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal{{$service->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Service</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('service.update', $service->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $service->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3">{{ $service->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="team_id" class="form-label">Assigned Team</label>
                            <select class="form-select" name="team_id">
                                <option value="">Select Team</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ $service->team_id == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <div class="row">
                                <div class="col-lg-2 col-md-12 col-12">
                                    @if($service->image)
                                        <img src="{{ Storage::url('services/' . $service->image) }}"
                                             alt="Service"
                                             width="50px"
                                             height="50px"
                                             class="rounded">
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
                        text: "Your service has been deleted.",
                        icon: "success"
                    }).then(()=>{
                        document.getElementById('delete-service-' + id).submit();
                    });
                }
            });
        }
    </script>
@endsection

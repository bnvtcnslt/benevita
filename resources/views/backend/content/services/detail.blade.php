@extends('layouts.main')
@section('content')
    <div class="row mt-4">
        <div class="col-lg-12 col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="fw-bold">Service Details</h4>
                    <div class="row mt-4">
                        <div class="col-lg-4 col-md-4 col-12 mb-4">
                            <img src="{{ Storage::url('/services/' . $service->image) }}"
                                 alt="Service Image"
                                 class="img-fluid rounded"
                                 style="max-height: 300px; object-fit: cover;">
                        </div>
                        <div class="col-lg-8 col-md-8 col-12">
                            <h3>{{ $service->title }}</h3>
                            <p class="text-muted">Added on {{ date('d M Y', strtotime($service->created_at)) }}</p>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <strong>Team Member:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $service->team ? $service->team->name : 'N/A' }}
                                    @if($service->team)
                                        <span class="text-muted">({{ $service->team->position }})</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Description</h5>
                                <p>{{ $service->description }}</p>
                            </div>

                            <div class="d-flex justify-content-start">
                                <a href="{{ route('service.index') }}" class="btn btn-secondary me-2">Back to List</a>
                                <a href="#" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#updateModal{{ $service->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form id="delete-service-{{ $service->id }}" action="{{ route('service.destroy', $service->id) }}" method="post" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $service->id }})" class="btn btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update -->
    <div class="modal fade" id="updateModal{{ $service->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
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
                            <input type="text" class="form-control" name="title" value="{{ $service->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3">{{ $service->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="team_id" class="form-label">Team Member</label>
                            <select class="form-control" name="team_id">
                                <option value="">Select Team Member</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ $service->team_id == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }} - {{ $team->position }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <div class="row">
                                <div class="col-lg-2 col-md-12 col-12">
                                    <img src="{{ Storage::url('/services/' . $service->image) }}" alt="Service Image" width="50px" height="50px">
                                </div>
                                <div class="col-lg-10 col-md-12 col-12">
                                    <input type="file" class="form-control mt-2" name="image">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $service->id }}">
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
        function confirmDelete(id) {
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
                        text: "Your file has been deleted.",
                        icon: "success"
                    }).then(() => {
                        document.getElementById('delete-service-' + id).submit();
                    });
                }
            });
        }
    </script>

@endsection

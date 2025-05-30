@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="fw-bold">Social Media List</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center align-middle">
                            <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Platform</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($social_media as $media)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $media->platform }}</td>
                                    <td>{{ $media->url }}</td>
                                    <td>
                                        <span class="badge {{ $media->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $media->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{ $media->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modals -->
    @foreach($social_media as $media)
        <div class="modal fade" id="updateModal{{ $media->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Edit Team Member</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('social_media.update', $media->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="role" class="form-label">Link URL</label>
                                <input type="text" class="form-control" name="url" value="{{ $media->url }}">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{($media->status == 1) ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{($media->status == 0) ? 'selected' : ''}}>Inactive</option>
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
@endsection

@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row">
                                <h3 class="fw-bold">Team Details</h3>
                                <div class="col-lg-4 col-md-4 col-12 mb-4">
                                    <img src="{{ Storage::url('/teams/' . $team->image) }}"
                                         alt="Team Image"
                                         class="img-fluid rounded"
                                         style="max-height: 300px; object-fit: cover;">
                                </div>
                                <div class="col-lg-8">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Team Information</h5>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-2">
                                                        <strong>Team ID:</strong> {{ $team->id }}
                                                    </p>
                                                    <p class="mb-2">
                                                        <strong>Date Added:</strong>
                                                        {{ $team->created_at ? $team->created_at->format('d M Y') : 'Not available' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-2">
                                                        <strong>Last Updated:</strong>
                                                        {{ $team->updated_at ? $team->updated_at->format('d M Y') : 'Not available' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Description</h5>
                                            <hr>
                                            <p>{{ $team->description ?? 'No description available' }}</p>
                                        </div>
                                    </div>

                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <h5 class="card-title">Team Members</h5>
                                            <hr>

                                            @if($members->count() > 0)
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Photo</th>
                                                            <th>Role</th>
                                                            <th>Status</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($members as $member)
                                                            <tr>
                                                                <td>{{ $member->name }}</td>
                                                                <td>
                                                                    <img src="{{ $member->image ? Storage::url('team_members/' . $member->image) : '/path/to/default/image.jpg' }}"
                                                                         alt="Team Member"
                                                                         class="rounded-circle"
                                                                         width="50"
                                                                         height="50"
                                                                         style="object-fit: cover">
                                                                </td>
                                                                <td>{{ $member->role }}</td>
                                                                <td>
                                                                    @if($member->trashed())
                                                                        <span class="badge bg-danger">Deleted</span>
                                                                    @else
                                                                        <span class="badge bg-success">Active</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <p class="text-muted">No members in this team yet.</p>
                                            @endif
                                            <!-- Pagination -->
                                            <nav aria-label="Team members pagination">
                                                <ul class="pagination justify-content-center mt-3">
                                                    <!-- Previous Page Link -->
                                                    <li class="page-item {{ $members->onFirstPage() ? 'disabled' : '' }}">
                                                        <a class="page-link"
                                                           href="{{ $members->appends(request()->except('member_page'))->previousPageUrl() }}#member-section"
                                                           aria-label="Previous">
                                                            <i class="bi bi-chevron-left"></i>
                                                        </a>
                                                    </li>

                                                    <!-- Dynamic Page Numbers -->
                                                    @php
                                                        $currentPage = $members->currentPage();
                                                        $lastPage = $members->lastPage();
                                                        $start = max($currentPage - 2, 1);
                                                        $end = min($currentPage + 2, $lastPage);

                                                        // Always show first page
                                                        if ($start > 1) {
                                                            echo '<li class="page-item"><a class="page-link" href="'.$members->url(1).'#member-section">1</a></li>';
                                                            if ($start > 2) {
                                                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                                            }
                                                        }

                                                        // Main page range
                                                        for ($i = $start; $i <= $end; $i++) {
                                                            $active = $currentPage == $i ? 'active' : '';
                                                            echo '<li class="page-item '.$active.'">';
                                                            echo '<a class="page-link" href="'.$members->url($i).'#member-section">'.$i.'</a>';
                                                            echo '</li>';
                                                        }

                                                        // Always show last page
                                                        if ($end < $lastPage) {
                                                            if ($end < $lastPage - 1) {
                                                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                                            }
                                                            echo '<li class="page-item"><a class="page-link" href="'.$members->url($lastPage).'#member-section">'.$lastPage.'</a></li>';
                                                        }
                                                    @endphp

                                                        <!-- Next Page Link -->
                                                    <li class="page-item {{ $members->hasMorePages() ? '' : 'disabled' }}">
                                                        <a class="page-link"
                                                           href="{{ $members->appends(request()->except('member_page'))->nextPageUrl() }}#member-section"
                                                           aria-label="Next">
                                                            <i class="bi bi-chevron-right"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <a href="{{ route('team.index') }}" class="btn btn-secondary me-2">
                                            <i class="bi bi-arrow-left"></i> Back to Team List
                                        </a>
                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{ $team->id }}">
                                            <i class="bi bi-pencil-square"></i> Edit Team
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal (same as in the index view) -->
    <div class="modal fade" id="updateModal{{ $team->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Team Member</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('team.update', $team->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $team->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3">{{ $team->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <div class="row">
                                <div class="col-lg-2 col-md-12 col-12">
                                    <img src="{{ Storage::url('/teams/' . $team->image) }}" alt="Team Member" width="50px" height="50px">
                                </div>
                                <div class="col-lg-10 col-md-12 col-12">
                                    <input type="file" class="form-control mt-2" name="image">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $team->id }}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

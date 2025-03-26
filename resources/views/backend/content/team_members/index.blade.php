@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="fw-bold">Team Member List</h4>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="col-lg-4">
                            <form action="{{ route('team_members.search') }}" method="GET">
                                <div class="input-group input-group-sm align-items-center">
                                    <input type="text" name="query" class="form-control" placeholder="Search for team members..." value="{{ request()->input('query') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-sm" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto text-end d-flex justify-content-end">
                            <button class="btn btn-primary d-flex align-items-center px-2" style="font-size: 0.8rem;" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="bi bi-plus-lg me-2 d-none d-sm-block"></i>
                                <span class="d-block d-sm-none">+ Add</span>
                                <span class="d-none d-sm-block">Add Member</span>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center align-middle">
                            <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Position</th>
                                <th>Photo</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($team_members as $member)
                                <tr>
                                    <td>{{ ($team_members->currentPage() - 1) * $team_members->perPage() + $loop->iteration }}</td>
                                    <td>{{ $member->id }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->role }}</td>
                                    <td>{{ $member->team->name }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ $member->image ? Storage::url('team_members/' . $member->image) : '/path/to/default/image.jpg' }}"
                                                 alt="Team Member"
                                                 class="rounded-circle"
                                                 width="50"
                                                 height="50"
                                                 style="object-fit: cover">
                                        </div>
                                    </td>
                                    <td>{{ $member->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{ $member->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('team_members.destroy', $member->id) }}" method="POST" id="delete-member-{{ $member->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a onclick="confirmDelete({{ $member->id }})" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
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
                            <li class="page-item {{ $team_members->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $team_members->previousPageUrl() }}" aria-label="Previous">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>

                            @php
                                $currentPage = $team_members->currentPage();
                                $lastPage = $team_members->lastPage();
                                $start = max($currentPage - 2, 1);
                                $end = min($currentPage + 2, $lastPage);

                                if ($start > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="' . $team_members->url(1) . '">1</a></li>';
                                    if ($start > 2) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                }

                                for ($i = $start; $i <= $end; $i++) {
                                    $active = $currentPage == $i ? 'active' : '';
                                    echo '<li class="page-item ' . $active . '"><a class="page-link" href="' . $team_members->url($i) . '">' . $i . '</a></li>';
                                }

                                if ($end < $lastPage) {
                                    if ($end < $lastPage - 1) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                    echo '<li class="page-item"><a class="page-link" href="' . $team_members->url($lastPage) . '">' . $lastPage . '</a></li>';
                                }
                            @endphp

                            <li class="page-item {{ $team_members->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $team_members->nextPageUrl() }}" aria-label="Next">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Team Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('team_members.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="role" name="role">
                        </div>
                        <div class="mb-3">
                            <label for="team_id" class="form-label">Team</label>
                            <select name="team_id" class="form-control" required>
                                <option value="" selected disabled>Select Team</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image" name="image" required>
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

    <!-- Update Modals -->
    @foreach($team_members as $member)
        <div class="modal fade" id="updateModal{{ $member->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Edit Team Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('team_members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $member->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control" name="role" value="{{ $member->role }}">
                            </div>
                            <div class="mb-3">
                                <label for="team_id" class="form-label">Team</label>
                                <select name="team_id" class="form-control" required>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ $member->team_id == $team->id ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <div class="row">
                                    <div class="col-lg-2 col-md-12 col-12">
                                        <img src="{{ $member->image ? Storage::url('team_members/' . $member->image) : '/path/to/default/image.jpg' }}"
                                             alt="Team Member"
                                             width="50"
                                             height="50"
                                             style="object-fit: cover;">
                                    </div>
                                    <div class="col-lg-10 col-md-12 col-12">
                                        <input type="file" class="form-control mt-2" name="image">
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
    @endforeach

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
                    document.getElementById('delete-member-' + id).submit();
                }
            });
        }
    </script>
@endsection

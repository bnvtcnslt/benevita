@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="fw-bold">Team List</h4>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="col-lg-4">
                            <form action="{{ route('team.search') }}" method="GET">
                                <div class="input-group input-group-sm align-items-center">
                                    <input type="text" name="query" class="form-control" placeholder="Search for teams..." value="{{ request()->input('query') }}">
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
                                <span class="d-none d-sm-block">Add Team</span>
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
                                <th>Description</th>
                                <th>Photo</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teams as $team)
                                <tr>
                                    <td>{{ ($teams->currentPage() - 1) * $teams->perPage() + $loop->iteration }}</td>
                                    <td>{{ $team->id }}</td>
                                    <td>{{$team->name}}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($team->description, 50) }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-center">
                                            <img src="{{Storage::url('/teams/' . $team->image)}}"
                                                 alt="Team"
                                                 class="rounded-circle"
                                                 width="50"
                                                 height="50"
                                                 style="object-fit: cover">
                                        </div>
                                    </td>
                                    <td>{{date('d M Y', strtotime($team->created_at))}}</td>
                                    <td>
                                        <a href="{{ route('team.show', $team->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{$team->id}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form id="delete-team-{{$team->id}}" action="{{route('team.destroy', $team->id)}}" method="post" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a onclick="confirmDelete({{$team->id}})" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
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
                            <li class="page-item {{ $teams->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $teams->previousPageUrl() }}" aria-label="Previous">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>

                            @php
                                $currentPage = $teams->currentPage();
                                $lastPage = $teams->lastPage();
                                $start = max($currentPage - 2, 1);
                                $end = min($currentPage + 2, $lastPage);

                                if ($start > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="' . $teams->url(1) . '">1</a></li>';
                                    if ($start > 2) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                }

                                for ($i = $start; $i <= $end; $i++) {
                                    $active = $currentPage == $i ? 'active' : '';
                                    echo '<li class="page-item ' . $active . '"><a class="page-link" href="' . $teams->url($i) . '">' . $i . '</a></li>';
                                }

                                if ($end < $lastPage) {
                                    if ($end < $lastPage - 1) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                    echo '<li class="page-item"><a class="page-link" href="' . $teams->url($lastPage) . '">' . $lastPage . '</a></li>';
                                }
                            @endphp

                            <li class="page-item {{ $teams->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $teams->nextPageUrl() }}" aria-label="Next">
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
                    <h5 class="modal-title" id="addModalLabel">Add Team</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('team.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Team Description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image" name="image">
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

    @foreach($teams as $team)
        <!-- Modal Update -->
        <div class="modal fade" id="updateModal{{$team->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Edit Team</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('team.update', $team->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{$team->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3">{{$team->description}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <div class="row">
                                    <div class="col-lg-2 col-md-12 col-12">
                                        <img src="{{ Storage::url('/teams/' . $team->image) }}" alt="Team" width="50px" height="50px">
                                    </div>
                                    <div class="col-lg-10 col-md-12 col-12">
                                        <input type="file" class="form-control mt-2" name="image">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$team->id}}">
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
                        text: "Your file has been deleted.",
                        icon: "success"
                    }).then(()=>{
                        document.getElementById('delete-team-' + id).submit();
                    });
                }
            });
        }
    </script>
@endsection

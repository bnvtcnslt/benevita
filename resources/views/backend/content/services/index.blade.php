@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="fw-bold">Services List</h4>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="col-lg-4">
                            <form action="{{ route('service.search') }}" method="GET">
                                <div class="input-group input-group-sm align-items-center">
                                    <input type="text" name="query" class="form-control" placeholder="Search for services..." value="{{ request()->input('query') }}">
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
                                <span class="d-none d-sm-block">Add Service</span>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center align-middle">
                            <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Team</th>
                                <th>Image</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{{ ($services->currentPage() - 1) * $services->perPage() + $loop->iteration }}</td>
                                    <td>{{$service->id}}</td>
                                    <td>{{$service->title}}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($service->description, 50) }}</td>
                                    <td>{{$service->team->name}}</td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-center">
                                            <img src="{{Storage::url('/services/' . $service->image)}}"
                                                 alt="Service Image"
                                                 class="rounded-circle"
                                                 width="50"
                                                 height="50"
                                                 style="object-fit: cover">
                                        </div>
                                    </td>
                                    <td>{{date('d M Y', strtotime($service->created_at))}}</td>
                                    <td>
                                        <a href="{{route('service.show', $service->id)}}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{$service->id}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form id="delete-service-{{$service->id}}" action="{{route('service.destroy', $service->id)}}" method="post" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a onclick="confirmDelete({{$service->id}})" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>

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
                            <li class="page-item {{ $services->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $services->previousPageUrl() }}" aria-label="Previous">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>

                            @php
                                $currentPage = $services->currentPage();
                                $lastPage = $services->lastPage();
                                $start = max($currentPage - 2, 1);
                                $end = min($currentPage + 2, $lastPage);

                                if ($start > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="' . $services->url(1) . '">1</a></li>';
                                    if ($start > 2) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                }

                                for ($i = $start; $i <= $end; $i++) {
                                    $active = $currentPage == $i ? 'active' : '';
                                    echo '<li class="page-item ' . $active . '"><a class="page-link" href="' . $services->url($i) . '">' . $i . '</a></li>';
                                }

                                if ($end < $lastPage) {
                                    if ($end < $lastPage - 1) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                    echo '<li class="page-item"><a class="page-link" href="' . $services->url($lastPage) . '">' . $lastPage . '</a></li>';
                                }
                            @endphp

                            <li class="page-item {{ $services->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $services->nextPageUrl() }}" aria-label="Next">
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
                    <h5 class="modal-title" id="addModalLabel">Add Service</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('service.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Service Title">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Service Description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="team_id" class="form-label">Team</label>
                            <select class="form-select" id="team_id" name="team_id">
                                <option value="" selected disabled>Select Team</option>
                                @foreach($teams as $team)
                                    <option value="{{$team->id}}">{{$team->name}} - {{$team->position}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
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

    @foreach($services as $service)
        <!-- Modal Update -->
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
                                <input type="text" class="form-control" name="title" value="{{$service->title}}">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3">{{$service->description}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="team_id" class="form-label">Team</label>
                                <select class="form-select" name="team_id">
                                    @foreach($teams as $team)
                                        <option value="{{$team->id}}" {{$service->team_id == $team->id ? 'selected' : ''}}>
                                            {{$team->name}} - {{$team->position}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <div class="row">
                                    <div class="col-lg-3 col-md-12 col-12">
                                        <img src="{{ Storage::url('/services/' . $service->image) }}" alt="Service Image" width="80px" height="50px" style="object-fit: cover">
                                    </div>
                                    <div class="col-lg-9 col-md-12 col-12">
                                        <input type="file" class="form-control mt-2" name="image">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$service->id}}">
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
                        document.getElementById('delete-service-' + id).submit();
                    });
                }
            });
        }
    </script>
@endsection

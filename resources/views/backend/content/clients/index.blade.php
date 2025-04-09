@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="fw-bold">Client List</h4>
                    <!-- Search and Add Button - Improved Responsive Layout -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
                        <!-- Search Form - Full width on mobile -->
                        <div class="col-12 col-md-5 col-lg-4 px-0">
                            <form action="{{ route('client.search') }}" method="GET">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="query" class="form-control" placeholder="Search for clients..." value="{{ request()->input('query') }}">
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
                                <span>Add Client</span>
                            </button>
                        </div>
                    </div>
                    <!-- Client Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center align-middle">
                            <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Date Added</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{ ($clients->currentPage() - 1) * $clients->perPage() + $loop->iteration }}</td>
                                    <td>{{$client->id}}</td>
                                    <td>{{$client->name}}</td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-center">
                                            <img src="{{Storage::url('clients/' . $client->logo_img)}}" alt="Client Member" class="rounded-circle" width="50" height="50" style="object-fit: cover">
                                        </div>
                                    </td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->phone}}</td>
                                    <td>{{$client->address}}</td>
                                    <td>{{date('d M Y', strtotime($client->created_at))}}</td>
                                    <td>
                                            <span class="badge {{ $client->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $client->status == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{$client->id}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form id="delete-client-{{$client->id}}" action="{{route('client.destroy', $client->id)}}" method="post" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="#" onclick="confirmDelete({{$client->id}})" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item {{ $clients->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $clients->previousPageUrl() }}" aria-label="Previous">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>
                            @php
                                $currentPage = $clients->currentPage();
                                $lastPage = $clients->lastPage();
                                $start = max($currentPage - 2, 1);
                                $end = min($currentPage + 2, $lastPage);
                                if ($start > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="' . $clients->url(1) . '">1</a></li>';
                                    if ($start > 2) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                }
                                for ($i = $start; $i <= $end; $i++) {
                                    $active = $currentPage == $i ? 'active' : '';
                                    echo '<li class="page-item ' . $active . '"><a class="page-link" href="' . $clients->url($i) . '">' . $i . '</a></li>';
                                }
                                if ($end < $lastPage) {
                                    if ($end < $lastPage - 1) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                    echo '<li class="page-item"><a class="page-link" href="' . $clients->url($lastPage) . '">' . $lastPage . '</a></li>';
                                }
                            @endphp
                            <li class="page-item {{ $clients->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $clients->nextPageUrl() }}" aria-label="Next">
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
                    <h5 class="modal-title" id="addModalLabel">Add Client</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('client.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" placeholder="Address" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="logo_img" class="form-label">Logo Client</label>
                            <input type="file" class="form-control" id="logo_img" name="logo_img" required>
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

    @foreach($clients as $client)
        <!-- Modal Update -->
        <div class="modal fade" id="updateModal{{$client->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Edit Client</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('client.update', $client->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{$client->name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{$client->email}}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{$client->phone}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" name="address" required>{{$client->address}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{($client->status == 1) ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{($client->status == 0) ? 'selected' : ''}}>Inactive</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="logo_img" class="form-label">Logo Client</label>
                                <div class="row">
                                    <div class="col-lg-2 col-md-12 col-12">
                                        <img src="{{ Storage::url('clients/' . $client->logo_img) }}" alt="Logo Client" width="50px" height="50px" class="rounded-circle">
                                    </div>
                                    <div class="col-lg-10 col-md-12 col-12">
                                        <input type="file" class="form-control mt-2" name="logo_img">
                                        <small class="text-muted">Leave empty if you don't want to change the logo</small>
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
                        document.getElementById('delete-client-' + id).submit();
                    });
                }
            });
        }
    </script>
@endsection

@extends('layouts.main')
@section('title', 'Clients')
@section('subtitle', 'Welcome to your list of clients')
@section('content')
    <div class="row mt-4">
        <div class="col-lg-12 col-12 col-md-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="fw-bold">Client List</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="bi bi-plus-lg"></i> Add Client
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center align-middle">
                            <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>
                                        <img src="{{Storage::url('/images/' . $client->logo_img)}}" alt="Logo Client" class="rounded-circle" width="50px" height="50px">
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
                                        <a onclick="confirmDelete({{$client->id}})" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
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

    <!-- Modal Add -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Modal title</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('client.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" placeholder="Address"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="logo_img" class="form-label">Logo Client</label>
                            <input type="file" class="form-control" id="logo_img" name="logo_img">
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
                                <input type="text" class="form-control" name="name" value="{{$client->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{$client->email}}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="number" class="form-control" name="phone" value="{{$client->phone}}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" name="address">{{$client->address}}</textarea>
                            </div>
                            <div class="mb-3 position-relative">
                                <select name="status" class="form-control">
                                    <option value="1" {{($client->status == 1) ? 'selected' : ''}}>Aktif</option>
                                    <option value="0" {{($client->status == 0) ? 'selected' : ''}}>Tidak Aktif</option>
                                </select>
                                <i class="bi bi-caret-down-fill position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); pointer-events: none;"></i>
                            </div>

                            <div class="mb-3">
                                <label for="logo_img" class="form-label">Logo Client</label>
                                <div class="row">
                                    <div class="col-lg-2 col-md-12 col-12">
                                        <img src="{{ Storage::url('/images/' . $client->logo_img) }}" alt="Logo Client" width="50px" height="50px">
                                    </div>
                                    <div class="col-lg-10 col-md-12 col-12">
                                        <input type="file" class="form-control mt-2" name="logo_img" value="{{$client->logo_img}}">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$client->id}}">
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



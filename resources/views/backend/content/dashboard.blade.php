@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2>Dashboard</h2>
                <p class="text-muted">Welcome to your dashboard</p>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="row mt-4">
            <!-- Total Clients -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('client.index') }}" class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light">
                                    <i class="bi bi-person-badge fs-4" style="color: #0A5640;"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="text-muted mb-0">Total Clients</p>
                                    <h5 class="fw-bold">{{ $clientCount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Total Team Members -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('team_members.index') }}" class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light">
                                    <i class="bi bi-people-fill fs-4" style="color: #0A5640;"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="text-muted mb-0">Total Team Members</p>
                                    <h5 class="fw-bold">{{ $memberCount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Total Services -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('service.index') }}" class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light">
                                    <i class="bi bi-briefcase fs-4" style="color: #fd7e14;"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="text-muted mb-0">Total Services</p>
                                    <h5 class="fw-bold">{{ $serviceCount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Total Testimonials -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('testimonial.index') }}" class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light">
                                    <i class="bi bi-chat-square-quote fs-4" style="color: #6f42c1;"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="text-muted mb-0">Total Testimonials</p>
                                    <h5 class="fw-bold">{{ $testimonialCount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Pending Messages -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('messages.index', ['filter' => 'pending']) }}" class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light">
                                    <i class="bi bi-envelope fs-4" style="color: #dc3545;"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="text-muted mb-0">Pending Messages</p>
                                    <h5 class="fw-bold">{{ $pendingMessagesCount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Social Media Links -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('social_media.index') }}" class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light">
                                    <i class="bi bi-share fs-4" style="color: #0d6efd;"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="text-muted mb-0">Social Media Links</p>
                                    <h5 class="fw-bold">{{ $socialMediaCount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Pending Messages Section -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0">Pending Messages</h5>
                    </div>
                    <div class="card-body">
                        @if(count($pendingMessages) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pendingMessages as $message)
                                        <tr onclick="window.location='{{ route('messages.index') }}'" style="cursor: pointer;">
                                            <td>{{ $message->full_name }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->subject ?? 'No Subject' }}</td>
                                            <td>{{ $message->created_at->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                <p class="mt-2 text-muted">No pending messages found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <style>
        .card {
            transition: transform 0.2s ease;
            border-radius: 0.75rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .rounded-circle {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(10, 86, 64, 0.1);
        }

        .bi {
            vertical-align: middle;
        }
    </style>
@endsection

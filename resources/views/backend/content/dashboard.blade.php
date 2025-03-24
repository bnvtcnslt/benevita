@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12 col-md-8">
                <h2>Dashboard</h2>
                <p class="text-muted">Welcome to your dashboard</p>
            </div>
        </div>
    </div>
        <!-- Dashboard Cards -->
        <div class="row mt-4">
            <!-- Total Team Members -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-light">
                                <i class="bi bi-people-fill fs-4" style="color: var(--dark-green);"></i>
                            </div>
                            <div class="ms-3">
                                <p class="text-muted mb-0">Total Team Members</p>
                                <h5 class="fw-bold">{{ $teamCount }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-light">
                                <i class="bi bi-person-badge fs-4" style="color: var(--dark-green);"></i>
                            </div>
                            <div class="ms-3">
                                <p class="text-muted mb-0">Total Clients</p>
                                <h5 class="fw-bold">{{ $clientCount }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-light">
                                <i class="bi bi-briefcase fs-4" style="color: var(--orange);"></i>
                            </div>
                            <div class="ms-3">
                                <p class="text-muted mb-0">Total Services</p>
                                <h5 class="fw-bold">1,543</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

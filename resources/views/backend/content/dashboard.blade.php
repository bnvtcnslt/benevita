@extends('layouts.main')
@section('title', 'Dashboard')
@section('subtitle', 'Welcome to your dashboard')
@section('content')
        <!-- Dashboard Cards -->
        <div class="row mt-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle p-3 bg-light">
                                <i class="bi bi-people fs-4" style="color: var(--orange);"></i>
                            </div>
                            <div class="ms-3">
                                <p class="text-muted mb-0">Total Users</p>
                                <h5 class="fw-bold">2,543</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle p-3 bg-light">
                                <i class="bi bi-graph-up fs-4" style="color: var(--dark-green);"></i>
                            </div>
                            <div class="ms-3">
                                <p class="text-muted mb-0">Total Sales</p>
                                <h5 class="fw-bold">$34,252</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle p-3 bg-light">
                                <i class="bi bi-star fs-4" style="color: var(--orange);"></i>
                            </div>
                            <div class="ms-3">
                                <p class="text-muted mb-0">Reviews</p>
                                <h5 class="fw-bold">4.8/5</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle p-3 bg-light">
                                <i class="bi bi-check-circle fs-4" style="color: var(--dark-green);"></i>
                            </div>
                            <div class="ms-3">
                                <p class="text-muted mb-0">Tasks</p>
                                <h5 class="fw-bold">24 Done</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

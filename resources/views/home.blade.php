@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Hero Section -->
    <div class="p-5 mb-4 bg-light rounded-3 border">
        <div class="container-fluid py-5">
            <h6 class="display-5 fw-bold">Welcome to our app</h6>
            <h1 class="display-5 fw-bold">HOME PAGE</h1>
            <p class="col-md-8 fs-4">This is a clean boilerplate using Laravel, Blade, and Bootstrap 5. It features a responsive layout, a sticky footer, and compiled assets via Vite.</p>
            <button class="btn btn-primary btn-lg" type="button" data-bs-toggle="modal" data-bs-target="#demoModal">
                Launch Demo Modal
            </button>
        </div>
    </div>

    Features Section
    <div class="row align-items-md-stretch mb-5">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Modern Backend</h5>
                    <p class="card-text">Powered by Laravel 12, offering robust routing, middleware, and database management.</p>
                    <a href="#" class="btn btn-outline-secondary">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Clean Frontend</h5>
                    <p class="card-text">Utilizes Blade templates for seamless server-side rendering and clean code structure.</p>
                    <a href="#" class="btn btn-outline-secondary">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Bootstrap 5</h5>
                    <p class="card-text">Styled with the world's most popular front-end toolkit for responsive, mobile-first sites.</p>
                    <a href="#" class="btn btn-outline-secondary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Demo Modal -->
<div class="modal fade" id="demoModal" tabindex="-1" aria-labelledby="demoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="demoModalLabel">Bootstrap JS Working!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                If you can see this modal, Bootstrap's JavaScript is successfully compiled and working with Vite.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

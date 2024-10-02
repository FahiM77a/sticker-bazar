@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Welcome Card -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Welcome, {{ Auth::check() ? Auth::user()->name : 'Guest' }}!</h2>
                </div>
                <div class="card-body">
                    <p class="lead text-center">
                        @if(Auth::check())
                            We're glad to have you here! Explore and enjoy our services.
                        @else
                            Please log in to access your account and our services.
                        @endif
                    </p>

                    <!-- Call to Action Buttons -->
                    <div class="text-center mt-4">
                        @if(Auth::check())
                            <a href="/fileUpload" class="btn btn-lg btn-success shadow-sm mr-3">Upload Files</a>

                            <!-- Logout Form -->
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf <!-- Include CSRF token -->
                                <button type="submit" class="btn btn-lg btn-danger shadow-sm">Logout</button>
                            </form>
                        @else
                            <a href="/login" class="btn btn-lg btn-primary shadow-sm">Login</a>
                            <a href="/register" class="btn btn-lg btn-secondary shadow-sm">Register</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-cloud-upload-alt fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Fast Uploads</h5>
                    <p class="card-text">Upload your files in seconds and access them from anywhere.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-file-download fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Secure Downloads</h5>
                    <p class="card-text">Your files are safe and can be downloaded anytime with secure links.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-user-shield fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Privacy Ensured</h5>
                    <p class="card-text">We value your privacy and ensure the security of your data.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .card-body i {
            color: #007bff;
        }
        .btn-lg {
            padding: 10px 30px;
            font-size: 1.2rem;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }
        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }
    </style>
@endsection

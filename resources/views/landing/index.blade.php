@extends('templates.layouts.landing')

@section('container')
    <style>
        .botto-text {
            color: #ffffff;
            font-size: 14px;
            margin: auto;
        }

        .card {
            border: none;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .card-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 30px;
            padding: 0.8rem 1.5rem;
            border: 1px solid #dee2e6;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 8px rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            border-radius: 30px;
            padding: 0.8rem 1.5rem;
            background: linear-gradient(to right, #007bff, #0056b3);
            border: none;
            transition: background 0.3s, transform 0.2s;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #0056b3, #007bff);
            transform: translateY(-3px);
        }

        .icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            font-size: 1.2rem;
            color: #6c757d;
        }

        .input-group {
            position: relative;
        }

        .input-group .form-control {
            padding-left: 2.5rem;
        }
    </style>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-5">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img src="{{ asset('storage/container/logo_app.png') }}" style="max-width: 150px; height: auto;"
                            class="img-fluid mb-4">
                        <div class="text-center mx-auto">
                            <h2 class="mb-2">Login</h2>
                            <p class="text-muted">Silakan masukkan username dan password Anda.</p>
                        </div>
                        @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form class="w-100" method="POST" action="/">
                            @csrf
                            <div class="mb-3 input-group">
                                <i class="icon bi bi-person"></i>
                                <input class="form-control" type="text" name="email" placeholder="Username" required>
                            </div>
                            <div class="mb-3 input-group">
                                <i class="icon bi bi-lock"></i>
                                <input class="form-control" type="password" name="password" placeholder="Password" required>
                            </div>
                            <button class="btn btn-primary d-block w-100 mb-3" type="submit">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <p class="botto-text text-center t">Copyright &copy; 2024 MyPOS Version 2.0. All Rights Reserved.</p>
    </div>
@endsection

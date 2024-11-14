@extends('templates.layouts.landing')

@section('container')
    <style>
        .botto-text {
            color: #ffffff;
            font-size: 14px;
            margin: auto;
        }
    </style>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-5">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img src="{{ asset('storage\container\logo_app.png') }}" style="max-width: 150px;height: 100%;"
                            class="img-fluid rounded-start">
                        <div class="text-center mx-auto">
                            <h2>Portal</h2>
                            <p class="w-lg-50">Masukkan username dan password Anda.</p>
                        </div>
                        @if (session()->has('loginError'))
                            <div class="container">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('loginError') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        <form class="text-center" method="POST" action="/">
                            @csrf
                            <div class="mb-3"><input class="form-control" type="text" name="email"
                                    placeholder="Username" required></div>
                            <div class="mb-3"><input class="form-control" type="password" name="password"
                                    placeholder="Password" required>
                            </div>
                            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Masuk ke
                                    Sistem</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <p class="botto-text text-center">Copyright MyPOS V2</p>
    </div>
@endsection

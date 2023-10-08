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
                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"><svg
                                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                viewBox="0 0 16 16" class="bi bi-person">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z">
                                </path>
                            </svg>
                        </div>
                        <div class="text-center mx-auto">
                            <h2>MyPOS V1 | Portal</h2>
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
                                    placeholder="Username"></div>
                            <div class="mb-3"><input class="form-control" type="password" name="password"
                                    placeholder="Password">
                            </div>
                            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Masuk ke
                                    Sistem</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <p class="botto-text text-center">Copyright MyPOS V1 | ValleyFeeds</p>
    </div>
@endsection

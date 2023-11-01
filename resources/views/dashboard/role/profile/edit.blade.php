@extends('templates.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Profil Saya</h1>
                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                    <div class="inner">
                        <div class="card-body">
                            <div class="d-flex">
                                <h4 class="card-title fw-semibold responsive-p1 me-3">Akun</h4>
                            </div>
                            <hr>
                            <div class="row">
                                <form class="row g-2 responsive-small fw-semibold" method="post"
                                    action="/dashboard/my-profile/edit">
                                    @csrf
                                    <div class="col-md-4 position-relative">
                                        <label for="validationCustom01" class="form-label ">Nama Lengkap<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="validationCustom01" class="form-control responsive-small"
                                            name="nama" value="{{ Auth()->user()->nama }}" placeholder="Isi Nama Lengkap"
                                            required>
                                    </div>
                                    <div class="col-md-6 position-relative">
                                        <label for="validationCustom01" class="form-label">Username<span
                                                class="text-danger">*</span></label>
                                        <input type="text" value="{{ Auth()->user()->email }}" id="validationCustom01"
                                            class="form-control responsive-small" name="email"
                                            placeholder="Isi Username Anda" required>
                                      
                                    </div>
                                    <div class="col-md-6 position-relative">
                                        <label for="inputCity" class="form-label">Password<span
                                                class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="password" class="form-control responsive-small" id="password"
                                                    placeholder="Isi Password" name="password" required>
                                            </div>
                                            <div class="col-auto">
                                                <h3><i class="bi bi-eye-slash" id="togglePassword"></i></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        (Wajib terisi untuk kolom dengan tanda "<span class="text-danger">*</span>").
                                    </p>
                                <button class="btn btn-primary fw-semibold text-white" type="submit">
                                        Ubah Data <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M20 4L3 9.31372L10.5 13.5M20 4L14.5 21L10.5 13.5M20 4L10.5 13.5"
                                                    stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div><!--//inner-->
                </div><!--//app-card-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
    <script>
        const togglePassword = document
            .querySelector('#togglePassword');

        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', () => {

            // Toggle the type attribute using
            // getAttribure() method
            const type = password
                .getAttribute('type') === 'password' ?
                'text' : 'password';

            password.setAttribute('type', type);

            // Toggle the eye and bi-eye icon
            this.classList.toggle('bi-eye');
        });
    </script>
@endsection

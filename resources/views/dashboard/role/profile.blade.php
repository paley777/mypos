@extends('templates.layouts.main')

@section('container')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <h1 class="app-page-title">Profil Saya</h1>
                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                    <div class="inner">
                        <div class="app-card-body p-3 p-lg-4">
                            <h3 class="mb-3">Profil Saya</h3>
                            <div class="row gx-5 gy-3">
                                <div class="col-12 col-lg-12">
                                    <div>Nama Akun: {{ Auth::user()->nama }}</div>
                                    <div>Username: {{ Auth::user()->email }}</div>
                                    <div>Jenis Akun: {{ Auth::user()->role}}</div>
                                </div><!--//col-->
                            </div><!--//row-->
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div><!--//app-card-body-->

                    </div><!--//inner-->
                </div><!--//app-card-->

            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
@endsection

@extends('templates.layouts.main')

@section('container')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <h1 class="app-page-title">Tentang Sistem</h1>
                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                    <div class="inner">
                        <div class="app-card-body p-3 p-lg-4">
                            <h3 class="mb-3">Tentang Sistem</h3>
                            <div class="row gx-5 gy-3">
                                <div class="col-12 col-lg-12">
                                    <div><img class="me-2" style="height: 200px;"
                                            src="{{ asset('storage\container\logo_app.png') }}" alt="logo"></div>
                                    <div>Sistem ini bernama MyPOS dengan Versi Rilis 2.0, sistem ini berjenis Point of Sales
                                        yang berisi beragam fitur kasir dan invetaris toko.</div>
                                    <div>Sistem ini dirancang oleh <a
                                            href="https://www.linkedin.com/in/valleryan-virgil-zuliuskandar-50366a242/">Valleryan
                                            Virgil Zuliuskandar</a> dan <a
                                            href="https://www.linkedin.com/in/abdul-vaiz-vi/">Abdul Vaiz Vahry Iskandar</a> dengan framework Laravel 10.</div>
                                    <div>Credit: <small class="copyright">Designed with <span class="sr-only">love</span><i
                                                class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link"
                                                href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for
                                            developers</small></div>

                                </div><!--//col-->
                            </div><!--//row-->

                        </div><!--//app-card-body-->

                    </div><!--//inner-->
                </div><!--//app-card-->

            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
@endsection

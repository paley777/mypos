@extends('templates.layouts.main')

@section('container')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <h1 class="app-page-title">Profil Saya</h1>
                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                    <div class="inner">
                        <div class="card-body">
                            <div class="d-flex">
                                <h4 class="card-title fw-semibold responsive-p1 me-3">Ubah Profil</h4>
                                <a href="/dashboard/my-profile/edit" class="btn btn-warning fw-semibold  ms-auto"
                                    type="button" data-bss-hover-animate="tada">Perbarui Profil
                                    <?xml version="1.0" ?>
                                    <svg width="20px" height="20px" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <title />
                                        <g id="Complete">
                                            <g id="arrow-up-right">
                                                <g>
                                                    <polyline data-name="Right" fill="none" id="Right-2"
                                                        points="18.7 12.4 18.7 5.3 11.6 5.3" stroke="#000000"
                                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                    <line fill="none" stroke="#000000" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" x1="5.3"
                                                        x2="17.1" y1="18.7" y2="6.9" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 align-items-center d-flex justify-content-center">
                                    <?xml version="1.0" encoding="utf-8"?>
                                    <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                    <svg width="150px" height="150px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M12 22.01C17.5228 22.01 22 17.5329 22 12.01C22 6.48716 17.5228 2.01001 12 2.01001C6.47715 2.01001 2 6.48716 2 12.01C2 17.5329 6.47715 22.01 12 22.01Z"
                                            fill="#292D32" />
                                        <path
                                            d="M12 6.93994C9.93 6.93994 8.25 8.61994 8.25 10.6899C8.25 12.7199 9.84 14.3699 11.95 14.4299C11.98 14.4299 12.02 14.4299 12.04 14.4299C12.06 14.4299 12.09 14.4299 12.11 14.4299C12.12 14.4299 12.13 14.4299 12.13 14.4299C14.15 14.3599 15.74 12.7199 15.75 10.6899C15.75 8.61994 14.07 6.93994 12 6.93994Z"
                                            fill="#292D32" />
                                        <path
                                            d="M18.7807 19.36C17.0007 21 14.6207 22.01 12.0007 22.01C9.3807 22.01 7.0007 21 5.2207 19.36C5.4607 18.45 6.1107 17.62 7.0607 16.98C9.7907 15.16 14.2307 15.16 16.9407 16.98C17.9007 17.62 18.5407 18.45 18.7807 19.36Z"
                                            fill="#292D32" />
                                    </svg>
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-hover responsive-small">
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td>{{ Auth()->user()->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Username</td>
                                                <td>:</td>
                                                <td>{{ Auth()->user()->email }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Role</td>
                                                <td>:</td>
                                                <td>{{ Auth()->user()->role }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!--//inner-->
                </div><!--//app-card-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
@endsection

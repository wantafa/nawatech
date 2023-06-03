@extends('backend.index')
@section('title', 'Dashboard')
@section('isi-konten')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="alert alert-info" role="alert">
            <i class="bx bx-bell"></i>
            Hallo, {{ Auth::user()->name }} <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Selamat Datang Di Wanmoto</b>
          </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 order-1">
                {{-- <div class="row">
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <li class="d-flex pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="d-block mb-1">Paypal</small>
                                            <h6 class="mb-0">9999rb</h6>
                                        </div>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <li class="d-flex pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="d-block mb-1">Paypal</small>
                                            <h6 class="mb-0">9999rb</h6>
                                        </div>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <li class="d-flex pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="d-block mb-1">Paypal</small>
                                            <h6 class="mb-0">9999rb</h6>
                                        </div>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <li class="d-flex pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="d-block mb-1">Paypal</small>
                                            <h6 class="mb-0">9999rb</h6>
                                        </div>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

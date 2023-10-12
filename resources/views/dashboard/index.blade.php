@extends('layouts.dashboard')

@section('title')
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>الرئيسية</a>
                </div>

                <a href="#" class="header-elements-toggle text-body d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success border-0 alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            <p class="font-weight-semibold">{{ Session::get('success') }}</p>
        </div>
    @endif
    <!-- Main charts -->
    <div class="row">
        <div class="col-xl-12">

            <!-- Traffic sources -->
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Statistics</h6>
                    <div class="header-elements">
                        <label class="custom-control custom-switch custom-control-right">
                            <input type="checkbox" class="custom-control-input" checked>
                            <span class="custom-control-label">Live update</span>
                        </label>
                    </div>
                </div>
                <br>
                <br>


                {{-- <div class="card-body py-0"> --}}
                <div class="row"  style="height: 160px;">
                    <div class="col-lg-6 ">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <a href="{{ route('users.index') }}"
                                class="btn bg-transparent border-teal text-teal rounded-pill border-0 btn-icon mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor"
                                    class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                </svg>
                            </a>
                            <div>
                                <div class="font-weight-bold">
                                    <h3> Users</h3>
                                </div>
                                <span class="text-muted "><span class="badge badge-mark border-success mr-2"></span>
                                    {{ DB::table('users')->select('*')->count() }}
                                </span>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <a href="{{ route('products.index') }}"
                                class="btn bg-transparent border-indigo text-indigo rounded-pill border-0 btn-icon mr-3">


                                <svg xmlns="http://www.w3.org/2000/svg"  width="90" height="90" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                                  </svg>
                            </a>
                            <div>
                                <div class="font-weight-bold">
                                    <h3> Products </h3>
                                </div>

                                <span class="text-muted"><span class="badge badge-mark border-success mr-2"></span>
                                    {{ DB::table('products')->select('*')->count() }} </span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

    </div>


    <!-- /main charts -->
@endsection

@section('script')
    <script src="{{ asset('backend/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
@endsection

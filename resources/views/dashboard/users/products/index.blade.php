@extends('layouts.dashboard')

@section('title')
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> الرئيسية</a>
                    <a href="{{ route('users.index') }}" class="breadcrumb-item"> المستخدمين</a>
                    <span class="breadcrumb-item active">{{ $user->first_name ." ". $user->last_name }}</span>
                    <span class="breadcrumb-item">منتجات المستخدم</span>
                </div>
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
    <!-- State saving -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">منتجات المستخدم</h5>
        </div>

        <table class="table datatable-button-init-basic table-bordered">
            <thead>
                <tr>
                    <th class="text-center">م</th>
                    <th class=" text-center"> اسم المنتج</th>
                    <th class=" text-center"> صورة المنتج</th>
                    <th class="text-center"> الوصف</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->products as $product)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td><a href="{{ ($product->getMedia('image')->first() != null) ? $product->getMedia('image')->first()->getUrl() : '' }}" target="_blank">
                                <div>
                                    <img src=" {{  ($product->getMedia('image')->first() != null) ? $product->getMedia('image')->first()->getUrl() : '' }}" width="60" height="60" class="rounded-circle"
                                        alt="">
                                </div>
                            </a>
                        </td>
                        <td>{{ $product->description ?? null }}</td>

                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /state saving -->
@endsection

@section('script')
    <script src="{{ asset('backend/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_pages/datatables_extension_buttons_init.js') }}"></script>
@endsection

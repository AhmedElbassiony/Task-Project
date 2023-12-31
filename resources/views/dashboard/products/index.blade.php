@extends('layouts.dashboard')

@section('title')
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> الرئيسية</a>
                    <span class="breadcrumb-item active">المنتجات </span>
                </div>
                <a href="#" class="header-elements-toggle text-body d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none">
                <div class="breadcrumb justify-content-center">
                    <a href="{{ route('products.create') }}" class="breadcrumb-elements-item font-weight-bold">
                        <i class="icon-plus2 mr-2"></i>
                        اضافة منتج جديد
                    </a>
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
            <h5 class="card-title">المنتجات</h5>
        </div>
        <div class="table-responsive p-3 ">
            <table class="table datatable-button-init-basic table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">م</th>
                        <th class=" text-center"> اسم المنتج</th>
                        <th class=" text-center"> صورة المنتج</th>
                        <th class="text-center"> الوصف</th>
                        <th class="text-center"> تاريخ الانشاء</th>
                        <th class="actions text-center">العمليات</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- /state saving -->
@endsection
@section('script')
    <script src="{{ asset('backend/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script>
        var table = $('.datatable-button-init-basic').DataTable({
            ajax: '{{ route('products.data') }}',
            columns: [{
                    data: "id",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "name"
                },
                {
                    data: "product_image"
                },

                {
                    data: "description"
                },

                {
                    data: "created_at"
                },
                {
                    data: "actions"
                },


            ],
        });
    </script>
@endsection

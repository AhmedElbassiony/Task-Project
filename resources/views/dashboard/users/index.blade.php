@extends('layouts.dashboard')

@section('title')
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> الرئيسية</a>
                    <span class="breadcrumb-item active">المستخدمين </span>
                </div>
                <a href="#" class="header-elements-toggle text-body d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none">
                <div class="breadcrumb justify-content-center">
                    <a href="{{ route('users.create') }}" class="breadcrumb-elements-item font-weight-bold">
                        <i class="icon-plus2 mr-2"></i>
                        اضافة مستخدم جديد
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
            <h5 class="card-title">المستخدمين </h5>
        </div>

        <table class="table datatable-button-init-basic table-bordered text-center">
            <thead>
                <tr>
                    <th class="text-center">التسلسل</th>
                    <th class="text-center">الاسم الاول</th>
                    <th class="text-center">الاسم الاخير</th>
                    <th class="text-center">البريد الالكترونى</th>
                    <th class="text-center">رقم الموبايل</th>
                    <th class="text-center">اجهزة المستخدم </th>
                    <th class="text-center">حالة الحساب </th>
                    <th class="actions text-center">العمليات</th>
                </tr>
            </thead>
        </table>
    </div>
    <!-- /state saving -->
@endsection

@section('script')
    <script src="{{ asset('backend/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_pages/form_select2.js') }}"></script>
    <script>
        var table = $('.datatable-button-init-basic').DataTable({
            ajax: '{{ route('users.data') }}',
            columns: [{
                    data: "id",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                {
                    data: "link"
                },
                {
                    data: "last_name"
                },
                {
                    data: "email"
                },
                {
                    data: "mobile"
                },
                {
                    data: "products[].name",
                    render: function(data, type) {
                        var x = '';
                        for (let i = 0; i < data.length; i++) {

                            x += '<span class="badge badge-flat border-dark text-dark ml-2 mt-1">' + data[
                                    i] + '</span>' +
                                '<br>';
                        }
                        return x;
                    }
                },

                {
                    data: "status"
                },

                {
                    data: "actions"
                },
            ],
        });
    </script>
@endsection

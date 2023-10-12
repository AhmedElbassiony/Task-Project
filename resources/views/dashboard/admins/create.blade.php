@extends('layouts.dashboard')

@section('title')
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> الرئيسية</a>
                    <a href="{{ route('admins.index') }}" class="breadcrumb-item">المسئولين </a>
                    <span class="breadcrumb-item active">اضافة مسئول جديد</span>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">اضافة مسئول جديد</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="reload"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admins.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>الاسم الاول</label>
                            <input type="text" class="form-control" name="first_name" placeholder="الاسم الاول "
                                value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <label id="basic-error" class="validation-invalid-label"
                                    for="basic">{{ $message }}</label>
                            @enderror

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>الاسم الاخير</label>
                            <input type="text" class="form-control" name="last_name" placeholder="الاسم الاخير "
                                value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <label id="basic-error" class="validation-invalid-label"
                                    for="basic">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>البريد الالكتروني</label>
                            <input type="text" class="form-control" name="email" placeholder="البريد الالكتروني"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <label id="basic-error" class="validation-invalid-label"
                                    for="basic">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>الموبايل</label>
                            <input type="number" class="form-control" name="mobile" placeholder="الموبايل"
                                value="{{ old('mobile') }}" required>
                            @error('mobile')
                                <label id="basic-error" class="validation-invalid-label"
                                    for="basic">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label>كلمة السر</label>
                            <input type="text" class="form-control" name="password" placeholder="كلمة السر"
                                value="{{ old('password') }}">
                            @error('password')
                                <label id="basic-error" class="validation-invalid-label"
                                    for="basic">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <input type="button" onclick="myFunction()" class="form-control btn btn-primary mt-4"
                                value="تجديد كلمة السر">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{ route('admins.index') }}" class="btn btn-link">الغاء</a>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_pages/form_select2.js') }}"></script>
    <script>
        function myFunction() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'GET',
                url: "{{ route('generate-password') }}",
                success: function(data) {
                    console.log(data.data);
                    document.getElementsByName("password")[0].value = data.data;
                }
            });
        }
    </script>
@endsection

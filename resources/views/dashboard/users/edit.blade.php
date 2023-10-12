@extends('layouts.dashboard')

@section('title')
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> الرئيسية</a>
                    <a href="{{ route('users.index') }}" class="breadcrumb-item">المستخدمين </a>
                    <span class="breadcrumb-item active">تعديل المستخدم</span>
                    <span class="breadcrumb-item active">{{ $user->first_name . ' ' . $user->last_name }}</span>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">تعديل المستخدم </h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="reload"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <fieldset>
                    <legend class="font-weight-semibold">
                        <i class="icon-file-text2 mr-2"></i>
                        تعديل بيانات المستخدم
                        <a href="#" class="float-right text-body" data-toggle="collapse" data-target="#demo1">
                            <i class="icon-circle-down2"></i>
                        </a>
                    </legend>


                    <div class="collapse show" id="demo1">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>الاسم الاول</label>
                                    <input type="text" class="form-control" name="first_name" placeholder="الاسم الاول "
                                        value="{{ $user->first_name }}" required>
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
                                        value="{{ $user->last_name }}" required>
                                    @error('last_name')
                                        <label id="basic-error" class="validation-invalid-label"
                                            for="basic">{{ $message }}</label>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>البريد الالكتروني</label>
                                    <input type="text" class="form-control" name="email"
                                        placeholder="البريد الالكتروني" value="{{ $user->email }}" required>
                                    @error('email')
                                        <label id="basic-error" class="validation-invalid-label"
                                            for="basic">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>الموبايل</label>
                                    <input type="number" class="form-control" name="mobile" placeholder="الموبايل"
                                        value="{{ $user->mobile }}" required>
                                    @error('mobile')
                                        <label id="basic-error" class="validation-invalid-label"
                                            for="basic">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>حالة حساب </label>
                                    <select class="form-control select-search select2-hidden-accessible" data-fouc=""
                                        tabindex="-1" aria-hidden="true" name="verified">
                                        <option value=0 {{ $user->verified == false ? 'selected' : '' }}>موقوف</option>
                                        <option value=1 {{ $user->verified == true ? 'selected' : '' }}>مفعل</option>
                                    </select>
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
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="font-weight-semibold">
                        <i class="icon-file-text2 mr-2"></i>
                        تعديل اجهزة المستخدم
                        <a href="#" class="float-right text-body" data-toggle="collapse" data-target="#demo2">
                            <i class="icon-circle-down2"></i>
                        </a>
                    </legend>


                    <div class="collapse  show" id="demo2">

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>اختر الجهزة الخاصة بالمستخدم </label>
                                    <select class="form-control select-search select2-hidden-accessible" data-fouc=""
                                        tabindex="-1" aria-hidden="true" name="products[]" multiple="multiple">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ $user->products->where('id', $product->id)->first() ? 'selected' : '' }}>
                                                {{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{ route('users.index') }}" class="btn btn-link">الغاء</a>
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

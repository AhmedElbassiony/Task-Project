@extends('layouts.dashboard')

@section('title')
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> الرئيسية</a>
                    <a href="{{ route('products.index') }}" class="breadcrumb-item">المنتجات</a>
                    <span class="breadcrumb-item active">اضافة منتج جديد</span>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">اضافة منتج جديد</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="reload"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>اسم المنتج</label>
                            <input type="text" class="form-control" name="name" placeholder="اسم المنتج"
                                value="{{ old('name') }}" required>
                            @error('title')
                                <label id="basic-error" class="validation-invalid-label"
                                    for="basic">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label> اختر صورة المنتج</label>
                            <input type="file" class="form-control" name="image" required>
                            @error('image')
                                <label id="basic-error" class="validation-invalid-label"
                                    for="basic">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label>وصف المنتج</label>
                            <textarea type="text" class="form-control" rows="3" name="description" placeholder="وصف المنتج"
                                value="{{ old('description') }}">{{ old('description') }}</textarea>
                            @error('description')
                                <label id="basic-error" class="validation-invalid-label"
                                    for="basic">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{ route('products.index') }}" class="btn btn-link">الغاء</a>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_pages/form_select2.js') }}"></script>
@endsection

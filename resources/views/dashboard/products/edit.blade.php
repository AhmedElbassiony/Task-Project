@extends('layouts.dashboard')

@section('title')
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> الرئيسية</a>
                    <a href="{{ route('products.index') }}" class="breadcrumb-item">المنتجات</a>
                    <span class="breadcrumb-item active">تعديل المنتج</span>
                    <span class="breadcrumb-item active">{{ $product->name }}</span>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">تعديل بيانات المنتج</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="reload"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>اسم المنتج</label>
                            <input type="text" class="form-control" name="name" placeholder="اسم المنتج"
                                value="{{ $product->name }}" required>
                            @error('name')
                                <label id="basic-error" class="validation-invalid-label"
                                    for="basic">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label> تعديل صورة المنتج</label>
                            <input type="file" class="form-control" name="image">
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
                            <textarea type="text" class="form-control" name="description" placeholder="وصف المنتج"
                                value="{{ $product->description }}">{{ $product->description }}</textarea>
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

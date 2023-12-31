@extends('layouts.dashboard')

@section('title')
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> الرئيسية</a>
                    <a href="{{ route('client.index') }}" class="breadcrumb-item"> العملاء</a>
                    <span class="breadcrumb-item">اجهزه</span>
                    <a href="{{ route('client.show.products' , $user->id) }}"
                       class="breadcrumb-item"> {{ $user->name }}</a>
                    <span class="breadcrumb-item active">تعديل جهاز</span>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">تعديل جهاز</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="reload"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('client.update.products' , [$user->id,$product_user->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>السيريال</label>
                            <input type="text" class="form-control" name="sn" placeholder="السيريال"
                                   value="{{ $product_user->sn ?? null }}">
                            @error('sn')
                            <label id="basic-error" class="validation-invalid-label" for="basic">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>اختر الجهاز</label>
                            <select class="form-control select-search select2-hidden-accessible" data-fouc=""
                                    tabindex="-1" aria-hidden="true" name="co_product_id">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ $product_user->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label>اختر تاريخ التركيب</label>
                        <input class="form-control" type="date" name="installation_date" value="{{ date('Y-m-d', strtotime($product_user->installation_date)) ?? null }}">
                        @error('installation_date')
                        <label id="basic-error" class="validation-invalid-label" for="basic">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>ملاحظة</label>
                        <textarea class="form-control" name="description" id="description">{{$product_user->description}}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{ route('client.show.products' , $user->id) }}" class="btn btn-link">الغاء</a>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/notifications/jgrowl.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_pages/form_select2.js') }}"></script>

    <script src="{{ asset('backend/global_assets/js/demo_pages/picker_date_rtl.js') }}"></script>
@endsection

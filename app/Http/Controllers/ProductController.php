<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('dashboard.products.index');
    }

    public function data()
    {
        $products = Product::query();
        return DataTables::of($products)

            ->addColumn('actions', 'dashboard.products.data_table.actions')
            ->addColumn('product_image', function ($model) {
                return view('dashboard.products.data_table.product_image', ['image' => ($model->getMedia('image')->first() != null) ? $model->getMedia('image')->first()->getUrl() : '']);
            })
            ->addColumn('created_at', function ($model) {
                return $model->created_at->diffForHumans();
            })
            ->rawColumns(['actions', 'product_image', 'created_at'])
            ->toJson();
    }

    public function create()
    {

        return view('dashboard.products.create');
    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable',
            'image' => 'required|image|max:1048',
        ]);

        try {
            DB::transaction(function () use ($data) {
                $product = Product::create([
                    'name' => $data['name'],
                    'description' => $data['description'],
                ]);
                $product->addMediaFromRequest('image')->toMediaCollection('image');
            });
        } catch (\Exception $e) {
            session()->flash('error', "حدث خطأ عند إضافة منتج");
            return redirect()->route('products.index');
        }


        session()->flash('success', 'تم إضافة المنتج بنجاح');
        return redirect()->route('products.index');
    }

    public function edit(product $product)
    {
        return view('dashboard.products.edit', compact('product'));
    }

    public function update(Request $request, product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable',
            'image' => 'nullable|image|max:1048',

        ]);

        try {
            DB::transaction(function () use ($data, $request, $product) {
                $product->update([
                    'name' => $data['name'],
                    'description' => $data['description'],
                ]);

                if ($request->hasFile('image')) {
                    if ($product->getMedia('image')) {
                        $product->clearMediaCollection('image');
                    }
                    $product->addMediaFromRequest('image')->toMediaCollection('image');
                }
            });
        } catch (\Exception $e) {
            session()->flash('error', "حدث خطأ عند تعديل منتج");
            return redirect()->route('products.index');
        }


        session()->flash('success', 'تم تعديل  المنتج بنجاح');
        return redirect()->route('products.index');
    }



    public function destroy(product $product)
    {
        $product->delete();
        session()->flash('success', 'تم حذف  المنتج بنجاح');
        return redirect()->route('products.index');
    }
}

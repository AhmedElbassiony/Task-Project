<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return api_response(true, '', ProductResource::collection(Product::paginate()));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable',
            'image' => 'required|image|max:2048',
        ]);

        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        $product->addMediaFromRequest('image')->toMediaCollection('image');

        return api_response(true, 'Product added successfully', new ProductResource($product));
    }


    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);


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

        return api_response(true, 'Product updated successfully', new ProductResource($product));
    }

    public function destroy(Product $product)
    {
        $product->clearMediaCollection('image');
        $product->delete();
        return api_response(true, 'Product Deleted successfully');
    }

}

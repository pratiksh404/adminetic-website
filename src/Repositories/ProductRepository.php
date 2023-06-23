<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\ProductRepositoryInterface;
use Adminetic\Website\Http\Requests\ProductRequest;
use Adminetic\Website\Models\Admin\Product;
use Illuminate\Support\Facades\Cache;

class ProductRepository implements ProductRepositoryInterface
{
    // Product Index
    public function indexProduct()
    {
        $products = config('adminetic.caching', true)
            ? (Cache::has('products') ? Cache::get('products') : Cache::rememberForever('products', function () {
                return Product::orderBy('position')->get();
            }))
            : Product::orderBy('position')->get();

        return compact('products');
    }

    // Product Create
    public function createProduct()
    {
        //
    }

    // Product Store
    public function storeProduct(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        $this->syncAttribute($product);
        $this->uploadImage($product);
    }

    // Product Show
    public function showProduct(Product $product)
    {
        return compact('product');
    }

    // Product Edit
    public function editProduct(Product $product)
    {
        return compact('product');
    }

    // Product Update
    public function updateProduct(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        $this->syncAttribute($product);
        $this->uploadImage($product);
    }

    // Product Destroy
    public function destroyProduct(Product $product)
    {
        $product->delete();
    }

    // Upload Image
    private function uploadImage(Product $product)
    {
        if (request()->has('images')) {
            $product
                ->addFromMediaLibraryRequest(request()->images)
                ->toMediaCollection('images');
        }
    }

    // Sync Attribute
    private function syncAttribute(Product $product)
    {
        if (request()->has('product_attributes')) {
            $product->attributes()->detach();
            foreach (request()->product_attributes as $attribute_id => $values) {
                $product->attributes()->attach($attribute_id, [
                    'values' => json_encode($values),
                ]);
            }
        }
    }
}

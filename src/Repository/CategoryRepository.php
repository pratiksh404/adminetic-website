<?php

namespace App\Repositories;

use App\Models\Admin\Category;
use Illuminate\Support\Facades\Cache;
use App\Contracts\CategoryRepositoryInterface;
use App\Http\Requests\CategoryRequest;

class CategoryRepository implements CategoryRepositoryInterface
{
    // Category Index
    public function indexCategory()
    {
        $categories = config('coderz.caching', true)
            ? (Cache::has('categories') ? Cache::get('categories') : Cache::rememberForever('categories', function () {
                return Category::orderBy('position', 'asc')->get();
            }))
            : Category::orderBy('position', 'asc')->get();
        return compact('categories');
    }

    // Category Create
    public function createCategory()
    {
        $categories = Cache::get('categories', Category::latest()->get());
        return compact('categories');
    }

    // Category Store
    public function storeCategory(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        $this->uploadImage($category);
    }

    // Category Show
    public function showCategory(Category $category)
    {
        return compact('category');
    }

    // Category Edit
    public function editCategory(Category $category)
    {
        $categories = Cache::get('categories', Category::latest()->get());
        return compact('category', 'categories');
    }

    // Category Update
    public function updateCategory(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        $this->uploadImage($category);
    }

    // Category Destroy
    public function destroyCategory(Category $category)
    {
        $category->hardDelete('image');
        $category->delete();
    }

    // Upload Image
    protected function uploadImage(Category $category)
    {
        if (request()->image) {
            $thumbnails = [
                'storage' => 'website/category',
                'width' => '512',
                'height' => '512',
                'quality' => '90',
                'thumbnails' => [
                    [
                        'thumbnail-name' => 'small',
                        'thumbnail-width' => '100',
                        'thumbnail-height' => '100',
                        'thumbnail-quality' => '50'
                    ]
                ]
            ];
            $category->makeThumbnail('image', $thumbnails);
        }
    }
}

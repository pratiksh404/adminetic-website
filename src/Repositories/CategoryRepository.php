<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\CategoryRepositoryInterface;
use Adminetic\Website\Http\Requests\CategoryRequest;
use Adminetic\Website\Models\Admin\Category;
use Illuminate\Support\Facades\Cache;

class CategoryRepository implements CategoryRepositoryInterface
{
    // Category Index
    public function indexCategory()
    {
        $categories = config('adminetic.caching', true)
            ? (Cache::has('categories') ? Cache::get('categories') : Cache::rememberForever('categories', function () {
                return Category::orderBy('position')->get();
            }))
            : Category::orderBy('position')->get();

        // Parent Categories
        if (! Cache::has('parent_categories')) {
            Cache::rememberForever('parent_categories', function () {
                return Category::whoIsParent()->position()->get();
            });
        }

        return compact('categories');
    }

    // Category Create
    public function createCategory()
    {
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
        return compact('category');
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
        $category->delete();
    }

    // Upload Image
    private function uploadImage(Category $category)
    {
        if (request()->has('image')) {
            $category
                ->addFromMediaLibraryRequest(request()->image)
                ->toMediaCollection('image');
        }
        if (request()->has('icon_image')) {
            $category
                ->addFromMediaLibraryRequest(request()->icon_image)
                ->toMediaCollection('icon_image');
        }
    }
}

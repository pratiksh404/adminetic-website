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
                return Category::whereNull('parent_id')->with('childrenCategories')->orderBy('position')->get();
            }))
            : Category::whereNull('parent_id')->with('childrenCategories')->orderBy('position')->get();

        return compact('categories');
    }

    // Category Create
    public function createCategory()
    {
        $parentcategories = Category::whereNull('parent_id')->with('childrenCategories')->get();

        return compact('parentcategories');
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
        $parentcategories = Category::whereNull('parent_id')->with('childrenCategories')->get();

        return compact('category', 'parentcategories');
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
                'storage' => 'category/category',
                'width' => '512',
                'height' => '512',
                'quality' => '90',
                'thumbnails' => [
                    [
                        'thumbnail-name' => 'small',
                        'thumbnail-width' => '100',
                        'thumbnail-height' => '100',
                        'thumbnail-quality' => '50',
                    ],
                ],
            ];
            $category->makeThumbnail('image', $thumbnails);
        }
    }
}

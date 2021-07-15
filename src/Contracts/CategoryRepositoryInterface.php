<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Models\Admin\Category;
use Adminetic\Website\Http\Requests\CategoryRequest;

interface CategoryRepositoryInterface
{
    public function indexCategory();

    public function createCategory();

    public function storeCategory(CategoryRequest $request);

    public function showCategory(Category $Category);

    public function editCategory(Category $Category);

    public function updateCategory(CategoryRequest $request, Category $Category);

    public function destroyCategory(Category $Category);
}

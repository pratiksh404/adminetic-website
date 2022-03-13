<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\CategoryRequest;
use Adminetic\Website\Models\Admin\Category;

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

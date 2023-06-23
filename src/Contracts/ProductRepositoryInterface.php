<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\ProductRequest;
use Adminetic\Website\Models\Admin\Product;

interface ProductRepositoryInterface
{
    public function indexProduct();

    public function createProduct();

    public function storeProduct(ProductRequest $request);

    public function showProduct(Product $Product);

    public function editProduct(Product $Product);

    public function updateProduct(ProductRequest $request, Product $Product);

    public function destroyProduct(Product $Product);
}

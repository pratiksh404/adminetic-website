<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Models\Admin\Product;
use Illuminate\Http\Request;
use Adminetic\Website\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use Adminetic\Website\Contracts\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected $productRepositoryInterface;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->authorizeResource(Product::class, 'product');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.product.index', $this->productRepositoryInterface->indexProduct());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->productRepositoryInterface->storeProduct($request);
        return redirect(adminRedirectRoute('product'))->withSuccess('Product Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('website::admin.product.show', $this->productRepositoryInterface->showProduct($product));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('website::admin.product.edit', $this->productRepositoryInterface->editProduct($product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ProductRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->productRepositoryInterface->updateProduct($request, $product);
        return redirect(adminRedirectRoute('product'))->withInfo('Product Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productRepositoryInterface->destroyProduct($product);
        return redirect(adminRedirectRoute('product'))->withFail('Product Deleted Successfully.');
    }
}

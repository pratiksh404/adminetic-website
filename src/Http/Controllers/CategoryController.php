<?php

namespace Adminetic\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Category;
use Adminetic\Website\Http\Requests\CategoryRequest;
use Adminetic\Website\Contracts\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepositoryInterface;

    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
        $this->authorizeResource(Category::class, 'category');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index', $this->categoryRepositoryInterface->indexCategory());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create', $this->categoryRepositoryInterface->createCategory());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepositoryInterface->storeCategory($request);
        return redirect(adminRedirectRoute('category'))->withSuccess('Category Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.category.show', $this->categoryRepositoryInterface->showCategory($category));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', $this->categoryRepositoryInterface->editCategory($category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\CategoryRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryRepositoryInterface->updateCategory($request, $category);
        return redirect(adminRedirectRoute('category'))->withInfo('Category Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->categoryRepositoryInterface->destroyCategory($category);
        return redirect(adminRedirectRoute('category'))->withFail('Category Deleted Successfully.');
    }

    /**
     *
     * Reorder Category Model Data
     *
     */
    public function reorder_categories(Request $request)
    {
        foreach ($request->input('rows', []) as $row) {
            Category::find($row['id'])->update([
                'position' => $row['position']
            ]);
        }

        return response()->noContent();
    }
}

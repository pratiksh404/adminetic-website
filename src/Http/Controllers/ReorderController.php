<?php

namespace Adminetic\Website\Http\Controllers;

use Illuminate\Http\Request;
use Adminetic\Website\Models\Admin\Category;
use App\Http\Controllers\Controller;

class ReorderController extends Controller
{
    public function categoryChildrenReorder(Category $category)
    {
        return view('website::admin.category.children-reorder', compact('category'));
    }
}

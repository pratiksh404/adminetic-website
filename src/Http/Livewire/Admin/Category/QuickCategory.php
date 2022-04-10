<?php

namespace Adminetic\Website\Http\Livewire\Admin\Category;

use Adminetic\Website\Models\Admin\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class QuickCategory extends Component
{
    public $model;
    public $category_id;
    public $name;
    public $categoryid;

    protected $rules = [
        'name' => 'required|max:255',
    ];

    public function mount($model, $category_id = null)
    {
        $this->model = $model;
        $this->category_id = $category_id;
    }

    public function submit()
    {
        $category = Category::create([
            'code' => rand(100000, 999999),
            'model' => $this->model ?? 'All',
            'name' => $this->name,
            'category_id' => $this->categoryid ? ($this->categoryid != '' ? $this->categoryid : null) : null,
            'slug' => Str::slug($this->name),
        ]);

        $this->category_id = $category->id;

        $this->emit('quick_category_created');
    }

    public function render()
    {
        $parentcategories = Category::whereNull('parent_id')->where(function ($q) {
            $q->where('model', $this->model)->orWhere('model', 'All');
        })->with('childrenCategories')->get();

        return view('website::livewire.admin.category.quick-category', compact('parentcategories'));
    }
}

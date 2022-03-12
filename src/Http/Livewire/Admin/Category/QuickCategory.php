<?php

namespace Adminetic\Website\Http\Livewire\Admin\Category;

use Adminetic\Website\Models\Admin\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
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
            'model' => $this->model,
            'name' => $this->name,
            'category_id' => $this->categoryid ? ($this->categoryid != '' ? $this->categoryid : null) : null,
            'slug' => SlugService::createSlug(Category::class, 'slug', $this->name),
        ]);

        $this->category_id = $category->id;

        $this->emit('quick_category_created');
    }

    public function render()
    {
        $parentcategories = Category::whereNull('category_id')->with('childrenCategories')->get();

        return view('website::livewire.admin.category.quick-category', compact('parentcategories'));
    }
}

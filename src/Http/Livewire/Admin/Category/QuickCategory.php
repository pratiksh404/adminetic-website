<?php

namespace Adminetic\Website\Http\Livewire\Admin\Category;

use Livewire\Component;
use Adminetic\Website\Models\Admin\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;

class QuickCategory extends Component
{
    public $model;
    public $category_id;
    public $name;
    public $parent_id;

    protected $rules = [
        'name' => 'required|max:255',
    ];

    public function mount($model, $caegory_id = null)
    {
        $this->model = $model;
        $this->category_id = $caegory_id;
    }

    public function submit()
    {
        $category = Category::create([
            'code' => rand(100000, 999999),
            'model' => $this->model,
            'name' => $this->name,
            'parent_id' => $this->parent_id ? ($this->parent_id != '' ? $this->parent_id : null) : null,
            'slug' => SlugService::createSlug(Category::class, 'slug', $this->name),
        ]);

        $this->category_id = $category->id;

        $this->emit('quick_category_created');
    }
    public function render()
    {
        $categories = Category::where('model', trim($this->model))->latest()->get();
        return view('livewire.admin.category.quick-category', compact('categories'));
    }
}

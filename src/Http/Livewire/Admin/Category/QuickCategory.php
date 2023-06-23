<?php

namespace Adminetic\Website\Http\Livewire\Admin\Category;

use Adminetic\Website\Models\Admin\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Component;

class QuickCategory extends Component
{
    public $parent_categories;

    public $model;

    public $attribute;

    public $category_id;

    public $category;

    public $label;

    public $category_panel_toggle = false;

    // Attributes
    public $name;
    public $parent_id;

    public function __construct($model = null, $attribute = 'category_id', $category_id = null, $label = 'Category')
    {
        $this->parent_categories = Cache::get('parent_categories', Category::whoIsParent()->position()->get());
        $this->model = $model;
        $this->attribute = $attribute;
        $this->category_id = $category_id;
        $this->label = $label;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|max:100',
            'parent_id' => 'nullable|numeric|exists:categories,id',
        ]);

        $category = Category::create([
            'root_parent_id' => $this->getMainCategory(),
            'parent_id' => $this->parent_id,
            'slug' => Str::slug($this->name),
            'model' => trim($this->model),
            'name' => $this->name,
        ]);

        $this->category_id = $category->id;

        $this->category_panel_toggle = false;

        $this->parent_categories = Category::whoIsParent()->position()->get();

        $this->name = null;
        $this->parent_id = null;

        $this->emit('quick_category_success', 'Category created successfully');
    }

    public function render()
    {
        return view('website::livewire.admin.category.quick-category');
    }

    // Get Main Category
    private function getMainCategory($given_category_id = null)
    {
        $parent_id = $given_category_id ?? $this->parent_id ?? null;
        $category = Category::find($parent_id);
        if (isset($category)) {
            while (true) {
                if (isset($category->parent_id)) {
                    $category = Category::find($category->parent_id);
                } else {
                    break;
                }
            }

            return $category->id;
        }

        return null;
    }
}

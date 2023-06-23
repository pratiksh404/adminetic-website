<?php

namespace Adminetic\Website\Http\Livewire\Admin\Product;

use Adminetic\Website\Models\Admin\Attribute;
use Livewire\Component;

class ProductAttribute extends Component
{
    public $product;
    public $attributes;
    public $product_attributes = [];
    public $selected_attribute_ids = [];
    public $selected_attributes;

    public function mount($product = null)
    {
        $this->product = $product;
        $this->attributes = Attribute::orderBy('position')->get();
        if (! is_null($product)) {
            $product_attributes = [];
            $this->selected_attribute_ids = $product->attributes->pluck('id')->toArray();
            $this->updatedSelectedAttributeIds();
            foreach ($product->attributes as $attr) {
                $product_attributes[$attr->id] = json_decode($attr->pivot->values, true);
            }
            $this->product_attributes = $product_attributes;
        }
    }

    public function updatedSelectedAttributeIds()
    {
        $this->selected_attributes = Attribute::find($this->selected_attribute_ids);
    }

    public function render()
    {
        return view('website::livewire.admin.product.product-attribute');
    }
}

<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\AttributeRepositoryInterface;
use Adminetic\Website\Http\Requests\AttributeRequest;
use Adminetic\Website\Models\Admin\Attribute;
use Illuminate\Support\Facades\Cache;

class AttributeRepository implements AttributeRepositoryInterface
{
    // Attribute Index
    public function indexAttribute()
    {
        $attributes = config('coderz.caching', true)
            ? (Cache::has('attributes') ? Cache::get('attributes') : Cache::rememberForever('attributes', function () {
                return Attribute::orderBy('position')->get();
            }))
            : Attribute::orderBy('position')->get();

        return compact('attributes');
    }

    // Attribute Create
    public function createAttribute()
    {
        //
    }

    // Attribute Store
    public function storeAttribute(AttributeRequest $request)
    {
        Attribute::create($request->validated());
    }

    // Attribute Show
    public function showAttribute(Attribute $attribute)
    {
        return compact('attribute');
    }

    // Attribute Edit
    public function editAttribute(Attribute $attribute)
    {
        return compact('attribute');
    }

    // Attribute Update
    public function updateAttribute(AttributeRequest $request, Attribute $attribute)
    {
        $attribute->update($request->validated());
    }

    // Attribute Destroy
    public function destroyAttribute(Attribute $attribute)
    {
        $attribute->delete();
    }
}

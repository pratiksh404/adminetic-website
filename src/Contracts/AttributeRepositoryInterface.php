<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\AttributeRequest;
use Adminetic\Website\Models\Admin\Attribute;

interface AttributeRepositoryInterface
{
    public function indexAttribute();

    public function createAttribute();

    public function storeAttribute(AttributeRequest $request);

    public function showAttribute(Attribute $Attribute);

    public function editAttribute(Attribute $Attribute);

    public function updateAttribute(AttributeRequest $request, Attribute $Attribute);

    public function destroyAttribute(Attribute $Attribute);
}

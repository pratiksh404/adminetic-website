<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Contracts\AttributeRepositoryInterface;
use Adminetic\Website\Http\Requests\AttributeRequest;
use Adminetic\Website\Models\Admin\Attribute;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    protected $attributeRepositoryInterface;

    public function __construct(AttributeRepositoryInterface $attributeRepositoryInterface)
    {
        $this->attributeRepositoryInterface = $attributeRepositoryInterface;
        $this->authorizeResource(Attribute::class, 'attribute');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.attribute.index', $this->attributeRepositoryInterface->indexAttribute());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\AttributeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $this->attributeRepositoryInterface->storeAttribute($request);

        return redirect(adminRedirectRoute('attribute'))->withSuccess('Attribute Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        return view('website::admin.attribute.show', $this->attributeRepositoryInterface->showAttribute($attribute));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        return view('website::admin.attribute.edit', $this->attributeRepositoryInterface->editAttribute($attribute));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\AttributeRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, Attribute $attribute)
    {
        $this->attributeRepositoryInterface->updateAttribute($request, $attribute);

        return redirect(adminRedirectRoute('attribute'))->withInfo('Attribute Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $this->attributeRepositoryInterface->destroyAttribute($attribute);

        return redirect(adminRedirectRoute('attribute'))->withFail('Attribute Deleted Successfully.');
    }
}

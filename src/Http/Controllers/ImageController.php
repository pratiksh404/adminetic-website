<?php

namespace Adminetic\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Image;
use Adminetic\Website\Http\Requests\ImageRequest;
use Adminetic\Website\Contracts\ImageRepositoryInterface;

class ImageController extends Controller
{
    protected $imageRepositoryInterface;

    public function __construct(ImageRepositoryInterface $imageRepositoryInterface)
    {
        $this->imageRepositoryInterface = $imageRepositoryInterface;
        $this->authorizeResource(Image::class, 'image');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.image.index', $this->imageRepositoryInterface->indexImage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageRequest $request)
    {
        $this->imageRepositoryInterface->storeImage($request);
        return redirect(adminRedirectRoute('image'))->withSuccess('Image Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return view('website::admin.image.show', $this->imageRepositoryInterface->showImage($image));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        return view('website::admin.image.edit', $this->imageRepositoryInterface->editImage($image));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ImageRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(ImageRequest $request, Image $image)
    {
        $this->imageRepositoryInterface->updateImage($request, $image);
        return redirect(adminRedirectRoute('image'))->withInfo('Image Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $this->imageRepositoryInterface->destroyImage($image);
        return redirect(adminRedirectRoute('image'))->withFail('Image Deleted Successfully.');
    }
}

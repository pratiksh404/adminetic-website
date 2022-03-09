<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Contracts\ImageRepositoryInterface;
use Adminetic\Website\Http\Requests\ImageRequest;
use Adminetic\Website\Models\Admin\Image;
use App\Http\Controllers\Controller;

class ImageRestAPIController extends Controller
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
        return response()->json($this->imageRepositoryInterface->indexImage(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageRequest $request)
    {
        $image = $this->imageRepositoryInterface->storeImage($request);

        return response()->json($image, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return response()->json($image, 200);
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

        return response()->json($image, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $deleted_item = $image;
        $image->delete();

        return response()->json($deleted_item, 200);
    }
}

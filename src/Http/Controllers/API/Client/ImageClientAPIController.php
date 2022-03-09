<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Http\Resources\Image\ImageCollection;
use Adminetic\Website\Http\Resources\Image\ImageResource;
use Adminetic\Website\Models\Admin\Image;
use App\Http\Controllers\Controller;

class ImageClientAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ImageCollection(Image::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return new ImageResource($image);
    }
}

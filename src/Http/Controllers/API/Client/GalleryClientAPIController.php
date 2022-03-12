<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Http\Resources\Gallery\GalleryCollection;
use Adminetic\Website\Http\Resources\Gallery\GalleryResource;
use Adminetic\Website\Models\Admin\Gallery;
use App\Http\Controllers\Controller;

class GalleryClientAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new GalleryCollection(Gallery::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        return new GalleryResource($gallery);
    }
}

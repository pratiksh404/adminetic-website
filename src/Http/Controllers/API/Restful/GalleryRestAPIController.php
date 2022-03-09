<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Contracts\GalleryRepositoryInterface;
use Adminetic\Website\Http\Requests\GalleryRequest;
use Adminetic\Website\Models\Admin\Gallery;
use App\Http\Controllers\Controller;

class GalleryRestAPIController extends Controller
{
    protected $galleryRepositoryInterface;

    public function __construct(GalleryRepositoryInterface $galleryRepositoryInterface)
    {
        $this->galleryRepositoryInterface = $galleryRepositoryInterface;
        $this->authorizeResource(Gallery::class, 'gallery');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->galleryRepositoryInterface->indexGallery(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\GalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $gallery = $this->galleryRepositoryInterface->storeGallery($request);

        return response()->json($gallery, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        return response()->json($gallery, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\GalleryRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $this->galleryRepositoryInterface->updateGallery($request, $gallery);

        return response()->json($gallery, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $deleted_item = $gallery;
        $gallery->delete();

        return response()->json($deleted_item, 200);
    }
}

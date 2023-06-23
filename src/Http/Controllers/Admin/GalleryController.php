<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Models\Admin\Gallery;
use Illuminate\Http\Request;
use Adminetic\Website\Http\Requests\GalleryRequest;
use App\Http\Controllers\Controller;
use Adminetic\Website\Contracts\GalleryRepositoryInterface;

class GalleryController extends Controller
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
        return view('website::admin.gallery.index', $this->galleryRepositoryInterface->indexGallery());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\GalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $this->galleryRepositoryInterface->storeGallery($request);
        return redirect(adminRedirectRoute('gallery'))->withSuccess('Gallery Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        return view('website::admin.gallery.show', $this->galleryRepositoryInterface->showGallery($gallery));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('website::admin.gallery.edit', $this->galleryRepositoryInterface->editGallery($gallery));
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
        return redirect(adminRedirectRoute('gallery'))->withInfo('Gallery Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $this->galleryRepositoryInterface->destroyGallery($gallery);
        return redirect(adminRedirectRoute('gallery'))->withFail('Gallery Deleted Successfully.');
    }
}

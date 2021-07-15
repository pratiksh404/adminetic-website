<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Models\Admin\Gallery;
use Adminetic\Website\Http\Requests\GalleryRequest;

interface GalleryRepositoryInterface
{
    public function indexGallery();

    public function createGallery();

    public function storeGallery(GalleryRequest $request);

    public function showGallery(Gallery $Gallery);

    public function editGallery(Gallery $Gallery);

    public function updateGallery(GalleryRequest $request, Gallery $Gallery);

    public function destroyGallery(Gallery $Gallery);
}

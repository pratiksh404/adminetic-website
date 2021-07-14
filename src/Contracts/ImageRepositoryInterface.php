<?php

namespace App\Contracts;

use App\Models\Admin\Image;
use App\Http\Requests\ImageRequest;

interface ImageRepositoryInterface
{
    public function indexImage();

    public function createImage();

    public function storeImage(ImageRequest $request);

    public function showImage(Image $Image);

    public function editImage(Image $Image);

    public function updateImage(ImageRequest $request, Image $Image);

    public function destroyImage(Image $Image);
}

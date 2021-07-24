<?php

namespace Adminetic\Website\Repository;

use Illuminate\Support\Facades\Cache;
use Adminetic\Website\Models\Admin\Image;
use Adminetic\Website\Http\Requests\ImageRequest;
use Adminetic\Website\Contracts\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    // Image Index
    public function indexImage()
    {
        $images = config('coderz.caching', true)
            ? (Cache::has('images') ? Cache::get('images') : Cache::rememberForever('images', function () {
                return Image::latest()->get();
            }))
            : Image::latest()->get();
        return compact('images');
    }

    // Image Create
    public function createImage()
    {
        //
    }

    // Image Store
    public function storeImage(ImageRequest $request)
    {
        $image = Image::create($request->validated());
        $this->uploadImage($image, $request);
    }

    // Image Show
    public function showImage(Image $image)
    {
        return compact('image');
    }

    // Image Edit
    public function editImage(Image $image)
    {
        return compact('image');
    }

    // Image Update
    public function updateImage(ImageRequest $request, Image $image)
    {
        $image->update($request->validated());
    }

    // Image Destroy
    public function destroyImage(Image $image)
    {
        $image->hardDelete('image');
        $image->delete();
    }

    // Image Upload 
    protected function uploadImage($image, $request)
    {
        if (request()->image) {
            $dimension = $this->calculateDimention($image, $request);
            $thumbnails = [
                'storage' => 'website/image/' . validImageFolder($image->type, 'image'),
                'width' => $dimension['width'],
                'height' => $dimension['height'],
                'quality' => '70',
                'thumbnails' => [
                    [
                        'thumbnail-name' => 'small',
                        'thumbnail-width' => $dimension['small-width'],
                        'thumbnail-height' => $dimension['small-height'],
                        'thumbnail-quality' => '30'
                    ]
                ]
            ];
            $image->makeThumbnail('image', $thumbnails);
        }
    }

    protected function calculateDimention($image, $request)
    {
        $dimention = array();
        if ($request->has('type')) {
            if ($request->type == 1 || $request->type == "Normal") {
                $dimention['width'] = 600;
                $dimention['height'] = 600;
                $dimention['small-width'] = 100;
                $dimention['small-height'] = 100;
            } elseif ($request->type == 2 || $request->type == "Horizontal") {
                $dimention['width'] = 800;
                $dimention['height'] = 600;
                $dimention['small-width'] = 150;
                $dimention['small-height'] = 100;
            } elseif ($request->type == 3 || $request->type == "Vertical") {
                $dimention['width'] = 600;
                $dimention['height'] = 800;
                $dimention['small-width'] = 100;
                $dimention['small-height'] = 150;
            } elseif ($request->type == 4 || $request->type == "Slider") {
                $dimention['width'] = 1920;
                $dimention['height'] = 1280;
                $dimention['small-width'] = 200;
                $dimention['small-height'] = 100;
            }
        } else {
            $dimention['width'] = 600;
            $dimention['height'] = 600;
            $dimention['small-width'] = 100;
            $dimention['small-height'] = 100;
        }
        return $dimention;
    }
}

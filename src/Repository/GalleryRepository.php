<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Adminetic\Website\Models\Admin\Gallery;
use Adminetic\Website\Http\Requests\GalleryRequest;
use Adminetic\Website\Http\Requests\GalleryImageRequest;
use Adminetic\Website\Contracts\GalleryRepositoryInterface;


class GalleryRepository implements GalleryRepositoryInterface
{
    // Gallery Index
    public function indexGallery()
    {
        $galleries = config('coderz.caching', true)
            ? (Cache::has('galleries') ? Cache::get('galleries') : Cache::rememberForever('galleries', function () {
                return Gallery::latest()->get();
            }))
            : Gallery::latest()->get();
        return compact('galleries');
    }

    // Gallery Create
    public function createGallery()
    {
        //
    }

    // Gallery Store
    public function storeGallery(GalleryRequest $request)
    {
        $gallery = Gallery::create($request->validated());
        $this->multipleImageUpload($gallery);
    }

    // Gallery Show
    public function showGallery(Gallery $gallery)
    {
        return compact('gallery');
    }

    // Gallery Edit
    public function editGallery(Gallery $gallery)
    {
        return compact('gallery');
    }

    // Gallery Update
    public function updateGallery(GalleryRequest $request, Gallery $gallery)
    {
        $gallery->update($request->validated());
        $this->multipleImageUpload($gallery);
    }

    // Gallery Destroy
    public function destroyGallery(Gallery $gallery)
    {
        $gallery->delete();
    }

    // Destroy Gallery Image Upload
    public function destroyGalleryImage(Request $request)
    {
        $image = Image::findOrFail($request->id);
        $image->hardDelete('image');
        $image->delete();
        return response()->json(['msg' => 'Gallery Image Deleted Successfully']);
    }

    // multiple Image Upload
    protected function multipleImageUpload($gallery)
    {
        if (request()->has('images')) {

            $imageRequest = app(\Adminetic\Website\Http\Requests\GalleryImageRequest::class, ['gallery' => $gallery]);
            $imageRequest->validated();
            foreach (request()->images as $image) {
                $img = $gallery->images()->create([
                    'image' => $image
                ]);

                // Multi Image Upload With Thumbnail
                $multiple = [
                    'storage' => 'website/gallery/' . validImageFolder($gallery->name, 'gallery'),
                    'width' => '600',
                    'height' => '600',
                    'quality' => '70',
                    'image' => $image,
                    'thumbnails' => [
                        [
                            'thumbnail-name' => 'small',
                            'thumbnail-width' => '100',
                            'thumbnail-height' => '100',
                            'thumbnail-quality' => '30'
                        ]
                    ]
                ];
                $img->makeThumbnail('image', $multiple);
            }
        }
    }
}

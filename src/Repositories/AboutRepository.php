<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Models\Admin\About;
use Illuminate\Support\Facades\Cache;
use Adminetic\Website\Contracts\AboutRepositoryInterface;
use Adminetic\Website\Http\Requests\AboutRequest;

class AboutRepository implements AboutRepositoryInterface
{
    // About Index
    public function indexAbout()
    {
        $abouts = config('adminetic.caching', true)
            ? (Cache::has('abouts') ? Cache::get('abouts') : Cache::rememberForever('abouts', function () {
                return About::latest()->get();
            }))
            : About::latest()->get();
        return compact('abouts');
    }

    // About Create
    public function createAbout()
    {
        //
    }

    // About Store
    public function storeAbout(AboutRequest $request)
    {
        $about = About::create($request->validated());
        $this->uploadImage($about);

    }

    // About Show
    public function showAbout(About $about)
    {
        return compact('about');
    }

    // About Edit
    public function editAbout(About $about)
    {
        return compact('about');
    }

    // About Update
    public function updateAbout(AboutRequest $request, About $about)
    {
        $about->update($request->validated());
        $this->uploadImage($about);

    }

    // About Destroy
    public function destroyAbout(About $about)
    {
        $about->delete();
    }

    // Upload Image
    private function uploadImage(About $about)
    {
        if (request()->has('image')) {
            $about
                ->addFromMediaLibraryRequest(request()->image)
                ->toMediaCollection('image');
        }
        if (request()->has('icon_image')) {
            $about
                ->addFromMediaLibraryRequest(request()->icon_image)
                ->toMediaCollection('icon_image');
        }
    }
}

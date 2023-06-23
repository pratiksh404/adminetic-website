<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Models\Admin\Software;
use Illuminate\Support\Facades\Cache;
use Adminetic\Website\Contracts\SoftwareRepositoryInterface;
use Adminetic\Website\Http\Requests\SoftwareRequest;

class SoftwareRepository implements SoftwareRepositoryInterface
{
    // Software Index
    public function indexSoftware()
    {
        $software = config('adminetic.caching', true)
            ? (Cache::has('software') ? Cache::get('software') : Cache::rememberForever('software', function () {
                return Software::orderBy('position')->get();
            }))
            : Software::orderBy('position')->get();
        return compact('software');
    }

    // Software Create
    public function createSoftware()
    {
        //
    }

    // Software Store
    public function storeSoftware(SoftwareRequest $request)
    {
        $software = Software::create($request->validated());
        $this->uploadImage($software);
    }

    // Software Show
    public function showSoftware(Software $software)
    {
        return compact('software');
    }

    // Software Edit
    public function editSoftware(Software $software)
    {
        return compact('software');
    }

    // Software Update
    public function updateSoftware(SoftwareRequest $request, Software $software)
    {
        $software->update($request->validated());
        $this->uploadImage($software);
    }

    // Software Destroy
    public function destroySoftware(Software $software)
    {
        $software->delete();
    }


    // Upload Image
    private function uploadImage(Software $software)
    {
        if (request()->has('images')) {
            $software
                ->addFromMediaLibraryRequest(request()->images)
                ->toMediaCollection('images');
        }
        if (request()->has('banner')) {
            $software
                ->addFromMediaLibraryRequest(request()->banner)
                ->toMediaCollection('banner');
        }
    }
}

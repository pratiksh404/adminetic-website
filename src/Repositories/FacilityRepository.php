<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\FacilityRepositoryInterface;
use Adminetic\Website\Http\Requests\FacilityRequest;
use Adminetic\Website\Models\Admin\Facility;
use Illuminate\Support\Facades\Cache;

class FacilityRepository implements FacilityRepositoryInterface
{
    // Facility Index
    public function indexFacility()
    {
        $facilities = config('adminetic.caching', true)
            ? (Cache::has('facilities') ? Cache::get('facilities') : Cache::rememberForever('facilities', function () {
                return Facility::orderBy('position')->get();
            }))
            : Facility::orderBy('position')->get();

        return compact('facilities');
    }

    // Facility Create
    public function createFacility()
    {
        //
    }

    // Facility Store
    public function storeFacility(FacilityRequest $request)
    {
        $facility = Facility::create($request->validated());
        $this->uploadImage($facility);
    }

    // Facility Show
    public function showFacility(Facility $facility)
    {
        return compact('facility');
    }

    // Facility Edit
    public function editFacility(Facility $facility)
    {
        return compact('facility');
    }

    // Facility Update
    public function updateFacility(FacilityRequest $request, Facility $facility)
    {
        $facility->update($request->validated());
        $this->uploadImage($facility);
    }

    // Facility Destroy
    public function destroyFacility(Facility $facility)
    {
        $facility->delete();
    }

    // Upload Image
    private function uploadImage(Facility $facility)
    {
        if (request()->has('image')) {
            $facility
                ->addFromMediaLibraryRequest(request()->image)
                ->toMediaCollection('image');
        }
        if (request()->has('icon_image')) {
            $facility
                ->addFromMediaLibraryRequest(request()->icon_image)
                ->toMediaCollection('icon_image');
        }
    }
}

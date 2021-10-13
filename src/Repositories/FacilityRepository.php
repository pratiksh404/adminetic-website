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
        isset($facility->image) ? $facility->hardDelete('image') : '';
        isset($facility->icon_image) ? deleteImage($facility->icon_image) : '';
        $facility->delete();
    }

    // Upload Image
    protected function uploadImage(Facility $facility)
    {
        if (request()->icon_image) {
            $facility->update([
                'icon_image' => request()->icon_image->store('website/facility/image', 'public'),
            ]);
            $image = Image::make(request()->file('icon_image')->getRealPath());
            $image->save(public_path('storage/' . $facility->icon_image));
        }

        if (request()->image) {
            $thumbnails = [
                'storage' => 'website/facility/image',
                'width' => '512',
                'height' => '512',
                'quality' => '80',
                'thumbnails' => [
                    [
                        'thumbnail-name' => 'small',
                        'thumbnail-width' => '150',
                        'thumbnail-height' => '100',
                        'thumbnail-quality' => '50',
                    ],
                ],
            ];
            $facility->makeThumbnail('image', $thumbnails);
        }
    }
}

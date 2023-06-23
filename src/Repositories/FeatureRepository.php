<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Models\Admin\Feature;
use Illuminate\Support\Facades\Cache;
use Adminetic\Website\Contracts\FeatureRepositoryInterface;
use Adminetic\Website\Http\Requests\FeatureRequest;

class FeatureRepository implements FeatureRepositoryInterface
{
    // Feature Index
    public function indexFeature()
    {
        $features = config('adminetic.caching', true)
            ? (Cache::has('features') ? Cache::get('features') : Cache::rememberForever('features', function () {
                return Feature::orderBy('position')->get();
            }))
            : Feature::orderBy('position')->get();
        return compact('features');
    }

    // Feature Create
    public function createFeature()
    {
        //
    }

    // Feature Store
    public function storeFeature(FeatureRequest $request)
    {
        $feature = Feature::create($request->validated());
        $this->uploadImage($feature);
    }

    // Feature Show
    public function showFeature(Feature $feature)
    {
        return compact('feature');
    }

    // Feature Edit
    public function editFeature(Feature $feature)
    {
        return compact('feature');
    }

    // Feature Update
    public function updateFeature(FeatureRequest $request, Feature $feature)
    {
        $feature->update($request->validated());
        $this->uploadImage($feature);
    }

    // Feature Destroy
    public function destroyFeature(Feature $feature)
    {
        $feature->delete();
    }

    // Upload Image
    private function uploadImage(Feature $feature)
    {
        if (request()->has('image')) {
            $feature
                ->addFromMediaLibraryRequest(request()->image)
                ->toMediaCollection('image');
        }
        if (request()->has('icon_image')) {
            $feature
                ->addFromMediaLibraryRequest(request()->icon_image)
                ->toMediaCollection('icon_image');
        }
    }
}

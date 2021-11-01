<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\FeatureRepositoryInterface;
use Adminetic\Website\Http\Requests\FeatureRequest;
use Adminetic\Website\Models\Admin\Feature;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class FeatureRepository implements FeatureRepositoryInterface
{
    // Feature Index
    public function indexFeature()
    {
        $features = config('adminetic.caching', true)
            ? (Cache::has('features') ? Cache::get('features') : Cache::rememberForever('features', function () {
                return Feature::latest()->get();
            }))
            : Feature::latest()->get();

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
        $feature->image ? deleteImage($feature->image) : '';
        $feature->delete();
    }

    // Upload Image
    protected function uploadImage(Feature $feature)
    {
        if (request()->image) {
            $feature->update([
                'image' => request()->image->store('website/feature/image', 'public'),
            ]);
            $image = Image::make(request()->file('image')->getRealPath());
            $image->save(public_path('storage/'.$feature->image));
        }
    }
}

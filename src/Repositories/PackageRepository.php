<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\PackageRepositoryInterface;
use Adminetic\Website\Http\Requests\PackageRequest;
use Adminetic\Website\Models\Admin\Package;
use Illuminate\Support\Facades\Cache;

class PackageRepository implements PackageRepositoryInterface
{
    // Package Index
    public function indexPackage()
    {
        $packages = config('adminetic.caching', true)
            ? (Cache::has('packages') ? Cache::get('packages') : Cache::rememberForever('packages', function () {
                return Package::orderBy('position')->get();
            }))
            : Package::orderBy('position')->get();

        return compact('packages');
    }

    // Package Create
    public function createPackage()
    {
        //
    }

    // Package Store
    public function storePackage(PackageRequest $request)
    {
        $package = Package::create($request->validated());
        $this->uploadImage($package);
    }

    // Package Show
    public function showPackage(Package $package)
    {
        return compact('package');
    }

    // Package Edit
    public function editPackage(Package $package)
    {
        return compact('package');
    }

    // Package Update
    public function updatePackage(PackageRequest $request, Package $package)
    {
        $package->update($request->validated());
        $this->uploadImage($package);
    }

    // Package Destroy
    public function destroyPackage(Package $package)
    {
        $package->delete();
    }

    // Upload Image
    private function uploadImage(Package $package)
    {
        if (request()->has('image')) {
            $package
                ->addFromMediaLibraryRequest(request()->image)
                ->toMediaCollection('image');
        }
        if (request()->has('icon_image')) {
            $package
                ->addFromMediaLibraryRequest(request()->icon_image)
                ->toMediaCollection('icon_image');
        }
    }
}

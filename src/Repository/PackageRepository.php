<?php

namespace App\Repositories;

use App\Models\Admin\Package;
use Illuminate\Support\Facades\Cache;
use App\Contracts\PackageRepositoryInterface;
use App\Http\Requests\PackageRequest;

class PackageRepository implements PackageRepositoryInterface
{
    // Package Index
    public function indexPackage()
    {
        $packages = config('coderz.caching', true)
            ? (Cache::has('packages') ? Cache::get('packages') : Cache::rememberForever('packages', function () {
                return Package::latest()->get();
            }))
            : Package::latest()->get();
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
        Package::create($request->validated());
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
    }

    // Package Destroy
    public function destroyPackage(Package $package)
    {
        $package->delete();
    }
}

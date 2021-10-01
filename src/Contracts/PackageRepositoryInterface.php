<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\PackageRequest;
use Adminetic\Website\Models\Admin\Package;

interface PackageRepositoryInterface
{
    public function indexPackage();

    public function createPackage();

    public function storePackage(PackageRequest $request);

    public function showPackage(Package $Package);

    public function editPackage(Package $Package);

    public function updatePackage(PackageRequest $request, Package $Package);

    public function destroyPackage(Package $Package);
}

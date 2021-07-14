<?php

namespace App\Contracts;

use App\Models\Admin\Package;
use App\Http\Requests\PackageRequest;

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

<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Http\Resources\Package\PackageCollection;
use Adminetic\Website\Http\Resources\Package\PackageResource;
use Adminetic\Website\Models\Admin\Package;
use App\Http\Controllers\Controller;

class PackageClientAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PackageCollection(Package::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return new PackageResource($package);
    }
}

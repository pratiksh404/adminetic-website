<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Contracts\PackageRepositoryInterface;
use Adminetic\Website\Http\Requests\PackageRequest;
use Adminetic\Website\Models\Admin\Package;
use App\Http\Controllers\Controller;

class PackageRestAPIController extends Controller
{
    protected $packageRepositoryInterface;

    public function __construct(PackageRepositoryInterface $packageRepositoryInterface)
    {
        $this->packageRepositoryInterface = $packageRepositoryInterface;
        $this->authorizeResource(Package::class, 'package');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->packageRepositoryInterface->indexPackage(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\PackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        $package = $this->packageRepositoryInterface->storePackage($request);

        return response()->json($package, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return response()->json($package, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\PackageRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, Package $package)
    {
        $this->packageRepositoryInterface->updatePackage($request, $package);

        return response()->json($package, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $deleted_item = $package;
        $package->delete();

        return response()->json($deleted_item, 200);
    }
}

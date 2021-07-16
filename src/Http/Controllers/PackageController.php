<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Package;
use Adminetic\Website\Http\Requests\PackageRequest;
use Adminetic\Website\Contracts\PackageRepositoryInterface;

class PackageController extends Controller
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
        return view('website::admin.package.index', $this->packageRepositoryInterface->indexPackage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\PackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        $this->packageRepositoryInterface->storePackage($request);
        return redirect(adminRedirectRoute('package'))->withSuccess('Package Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return view('website::admin.package.show', $this->packageRepositoryInterface->showPackage($package));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return view('website::admin.package.edit', $this->packageRepositoryInterface->editPackage($package));
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
        return redirect(adminRedirectRoute('package'))->withInfo('Package Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $this->packageRepositoryInterface->destroyPackage($package);
        return redirect(adminRedirectRoute('package'))->withFail('Package Deleted Successfully.');
    }
}

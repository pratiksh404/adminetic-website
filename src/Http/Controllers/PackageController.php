<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Package;
use Illuminate\Http\Request;
use App\Http\Requests\PackageRequest;
use App\Http\Controllers\Controller;
use App\Contracts\PackageRepositoryInterface;

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
        return view('admin.package.index', $this->packageRepositoryInterface->indexPackage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PackageRequest  $request
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
     * @param  \App\Models\Admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return view('admin.package.show', $this->packageRepositoryInterface->showPackage($package));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return view('admin.package.edit', $this->packageRepositoryInterface->editPackage($package));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PackageRequest  $request
     * @param  \App\Models\Admin\Package  $package
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
     * @param  \App\Models\Admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $this->packageRepositoryInterface->destroyPackage($package);
        return redirect(adminRedirectRoute('package'))->withFail('Package Deleted Successfully.');
    }
}

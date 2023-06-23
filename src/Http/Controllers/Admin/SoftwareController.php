<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Contracts\SoftwareRepositoryInterface;
use Adminetic\Website\Http\Requests\SoftwareRequest;
use Adminetic\Website\Models\Admin\Software;
use App\Http\Controllers\Controller;

class SoftwareController extends Controller
{
    protected $softwareRepositoryInterface;

    public function __construct(SoftwareRepositoryInterface $softwareRepositoryInterface)
    {
        $this->softwareRepositoryInterface = $softwareRepositoryInterface;
        $this->authorizeResource(Software::class, 'software');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.software.index', $this->softwareRepositoryInterface->indexSoftware());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.software.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\SoftwareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SoftwareRequest $request)
    {
        $this->softwareRepositoryInterface->storeSoftware($request);

        return redirect(adminRedirectRoute('software'))->withSuccess('Software Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function show(Software $software)
    {
        return view('website::admin.software.show', $this->softwareRepositoryInterface->showSoftware($software));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function edit(Software $software)
    {
        return view('website::admin.software.edit', $this->softwareRepositoryInterface->editSoftware($software));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\SoftwareRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function update(SoftwareRequest $request, Software $software)
    {
        $this->softwareRepositoryInterface->updateSoftware($request, $software);

        return redirect(adminRedirectRoute('software'))->withInfo('Software Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function destroy(Software $software)
    {
        $this->softwareRepositoryInterface->destroySoftware($software);

        return redirect(adminRedirectRoute('software'))->withFail('Software Deleted Successfully.');
    }
}

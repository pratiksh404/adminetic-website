<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Models\Admin\Service;
use Illuminate\Http\Request;
use Adminetic\Website\Http\Requests\ServiceRequest;
use App\Http\Controllers\Controller;
use Adminetic\Website\Contracts\ServiceRepositoryInterface;

class ServiceController extends Controller
{
    protected $serviceRepositoryInterface;

    public function __construct(ServiceRepositoryInterface $serviceRepositoryInterface)
    {
        $this->serviceRepositoryInterface = $serviceRepositoryInterface;
        $this->authorizeResource(Service::class, 'service');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.service.index', $this->serviceRepositoryInterface->indexService());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $this->serviceRepositoryInterface->storeService($request);
        return redirect(adminRedirectRoute('service'))->withSuccess('Service Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('website::admin.service.show', $this->serviceRepositoryInterface->showService($service));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('website::admin.service.edit', $this->serviceRepositoryInterface->editService($service));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ServiceRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $this->serviceRepositoryInterface->updateService($request, $service);
        return redirect(adminRedirectRoute('service'))->withInfo('Service Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $this->serviceRepositoryInterface->destroyService($service);
        return redirect(adminRedirectRoute('service'))->withFail('Service Deleted Successfully.');
    }
}

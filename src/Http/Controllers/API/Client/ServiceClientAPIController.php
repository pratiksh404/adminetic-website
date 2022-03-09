<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Http\Resources\Service\ServiceCollection;
use Adminetic\Website\Http\Resources\Service\ServiceResource;
use Adminetic\Website\Models\Admin\Service;
use App\Http\Controllers\Controller;

class ServiceClientAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ServiceCollection(Service::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return new ServiceResource($service);
    }
}

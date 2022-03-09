<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Models\Admin\Service;
use Adminetic\Website\Http\Resources\Service\ServiceCollection;
use Adminetic\Website\Http\Resources\Service\ServiceResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

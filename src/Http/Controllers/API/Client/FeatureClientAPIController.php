<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Models\Admin\Feature;
use Adminetic\Website\Http\Resources\Feature\FeatureCollection;
use Adminetic\Website\Http\Resources\Feature\FeatureResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeatureClientAPIController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new FeatureCollection(Feature::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        return new FeatureResource($feature);
    }
}

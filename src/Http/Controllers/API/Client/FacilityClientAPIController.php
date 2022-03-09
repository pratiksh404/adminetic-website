<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Models\Admin\Facility;
use Adminetic\Website\Http\Resources\Facility\FacilityCollection;
use Adminetic\Website\Http\Resources\Facility\FacilityResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacilityClientAPIController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new FacilityCollection(Facility::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        return new FacilityResource($facility);
    }
}

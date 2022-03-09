<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Models\Admin\Counter;
use Adminetic\Website\Http\Resources\Counter\CounterCollection;
use Adminetic\Website\Http\Resources\Counter\CounterResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CounterClientAPIController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CounterCollection(Counter::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function show(Counter $counter)
    {
        return new CounterResource($counter);
    }
}

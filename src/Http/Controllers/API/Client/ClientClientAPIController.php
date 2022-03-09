<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Client;
use Adminetic\Website\Http\Resources\Client\ClientResource;
use Adminetic\Website\Http\Resources\Client\ClientCollection;

class ClientClientAPIController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ClientCollection(Client::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }
}

<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Contracts\ClientRepositoryInterface;
use Adminetic\Website\Http\Requests\ClientRequest;
use Adminetic\Website\Models\Admin\Client;
use App\Http\Controllers\Controller;

class ClientRestAPIController extends Controller
{
    protected $clientRepositoryInterface;

    public function __construct(ClientRepositoryInterface $clientRepositoryInterface)
    {
        $this->clientRepositoryInterface = $clientRepositoryInterface;
        $this->authorizeResource(Client::class, 'client');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->clientRepositoryInterface->indexClient(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $client = $this->clientRepositoryInterface->storeClient($request);

        return response()->json($client, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return response()->json($client, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ClientRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $this->clientRepositoryInterface->updateClient($request, $client);

        return response()->json($client, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $deleted_item = $client;
        $client->delete();

        return response()->json($deleted_item, 200);
    }
}

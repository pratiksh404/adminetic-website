<?php

namespace Adminetic\Website\Http\Controllers;

use Adminetic\Website\Models\Admin\Client;
use Illuminate\Http\Request;
use Adminetic\Website\Http\Requests\ClientRequest;
use App\Http\Controllers\Controller;
use Adminetic\Website\Contracts\ClientRepositoryInterface;

class ClientController extends Controller
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
        return view('website::admin.client.index', $this->clientRepositoryInterface->indexClient());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $this->clientRepositoryInterface->storeClient($request);
        return redirect(adminRedirectRoute('client'))->withSuccess('Client Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('website::admin.client.show', $this->clientRepositoryInterface->showClient($client));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('website::admin.client.edit', $this->clientRepositoryInterface->editClient($client));
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
        return redirect(adminRedirectRoute('client'))->withInfo('Client Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $this->clientRepositoryInterface->destroyClient($client);
        return redirect(adminRedirectRoute('client'))->withFail('Client Deleted Successfully.');
    }
}

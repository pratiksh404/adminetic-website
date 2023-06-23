<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\ClientRequest;
use Adminetic\Website\Models\Admin\Client;

interface ClientRepositoryInterface
{
    public function indexClient();

    public function createClient();

    public function storeClient(ClientRequest $request);

    public function showClient(Client $Client);

    public function editClient(Client $Client);

    public function updateClient(ClientRequest $request, Client $Client);

    public function destroyClient(Client $Client);
}

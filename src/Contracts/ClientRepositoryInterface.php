<?php

namespace App\Contracts;

use App\Models\Admin\Client;
use App\Http\Requests\ClientRequest;

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

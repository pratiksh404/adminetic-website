<?php

namespace App\Contracts;

use Adminetic\Website\Models\Admin\Client;
use Adminetic\Website\Http\Requests\ClientRequest;


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

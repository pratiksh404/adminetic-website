<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\ClientRepositoryInterface;
use Adminetic\Website\Http\Requests\ClientRequest;
use Adminetic\Website\Models\Admin\Client;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ClientRepository implements ClientRepositoryInterface
{
    // Client Index
    public function indexClient()
    {
        $clients = config('adminetic.caching', true)
            ? (Cache::has('clients') ? Cache::get('clients') : Cache::rememberForever('clients', function () {
                return Client::latest()->get();
            }))
            : Client::latest()->get();

        return compact('clients');
    }

    // Client Create
    public function createClient()
    {
        //
    }

    // Client Store
    public function storeClient(ClientRequest $request)
    {
        $client = Client::create($request->validated());
        $this->uploadImage($client);
    }

    // Client Show
    public function showClient(Client $client)
    {
        return compact('client');
    }

    // Client Edit
    public function editClient(Client $client)
    {
        return compact('client');
    }

    // Client Update
    public function updateClient(ClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        $this->uploadImage($client);
    }

    // Client Destroy
    public function destroyClient(Client $client)
    {
        isset($client->image) ? deleteImage($client->image) : '';
        $client->delete();
    }

    // Image Upload
    protected function uploadImage(Client $client)
    {
        if (request()->has('image')) {
            $client->update([
                'image' => request()->image->store('website/client', 'public'),
            ]);
            $image = Image::make(request()->file('image')->getRealPath());
            $image->save(public_path('storage/'.$client->image));
        }
    }
}

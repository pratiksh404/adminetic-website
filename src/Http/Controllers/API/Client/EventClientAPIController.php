<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Models\Admin\Event;
use Adminetic\Website\Http\Resources\Event\EventCollection;
use Adminetic\Website\Http\Resources\Event\EventResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventClientAPIController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new EventCollection(Event::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }
}

<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Contracts\EventRepositoryInterface;
use Adminetic\Website\Http\Requests\EventRequest;
use Adminetic\Website\Models\Admin\Event;
use App\Http\Controllers\Controller;

class EventRestAPIController extends Controller
{
    protected $eventRepositoryInterface;

    public function __construct(EventRepositoryInterface $eventRepositoryInterface)
    {
        $this->eventRepositoryInterface = $eventRepositoryInterface;
        $this->authorizeResource(Event::class, 'event');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->eventRepositoryInterface->indexEvent(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\EventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $event = $this->eventRepositoryInterface->storeEvent($request);

        return response()->json($event, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return response()->json($event, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\EventRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $this->eventRepositoryInterface->updateEvent($request, $event);

        return response()->json($event, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $deleted_item = $event;
        $event->delete();

        return response()->json($deleted_item, 200);
    }
}

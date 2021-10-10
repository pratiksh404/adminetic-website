<?php

namespace Adminetic\Website\Http\Controllers;


use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Event;
use Adminetic\Website\Http\Requests\EventRequest;
use Adminetic\Website\Contracts\EventRepositoryInterface;

class EventController extends Controller
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
        return view('website::admin.event.index', $this->eventRepositoryInterface->indexEvent());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.event.create', $this->eventRepositoryInterface->createEvent());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\EventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $this->eventRepositoryInterface->storeEvent($request);
        return redirect(adminRedirectRoute('event'))->withSuccess('Event Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('website::admin.event.show', $this->eventRepositoryInterface->showEvent($event));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('website::admin.event.edit', $this->eventRepositoryInterface->editEvent($event));
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
        return redirect(adminRedirectRoute('event'))->withInfo('Event Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->eventRepositoryInterface->destroyEvent($event);
        return redirect(adminRedirectRoute('event'))->withFail('Event Deleted Successfully.');
    }
}

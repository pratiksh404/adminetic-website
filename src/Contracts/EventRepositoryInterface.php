<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\EventRequest;
use Adminetic\Website\Models\Admin\Event;

interface EventRepositoryInterface
{
    public function indexEvent();

    public function createEvent();

    public function storeEvent(EventRequest $request);

    public function showEvent(Event $Event);

    public function editEvent(Event $Event);

    public function updateEvent(EventRequest $request, Event $Event);

    public function destroyEvent(Event $Event);
}

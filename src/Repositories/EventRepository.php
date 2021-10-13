<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\EventRepositoryInterface;
use Adminetic\Website\Http\Requests\EventRequest;
use Adminetic\Website\Models\Admin\Event;
use Adminetic\Website\Models\Admin\Gallery;
use Illuminate\Support\Facades\Cache;

class EventRepository implements EventRepositoryInterface
{
    // Event Index
    public function indexEvent()
    {
        $events = config('adminetic.caching', true)
            ? (Cache::has('events') ? Cache::get('events') : Cache::rememberForever('events', function () {
                return Event::latest()->get();
            }))
            : Event::latest()->get();

        return compact('events');
    }

    // Event Create
    public function createEvent()
    {
        $galleries = Cache::get('galleries', Gallery::latest()->get());

        return compact('galleries');
    }

    // Event Store
    public function storeEvent(EventRequest $request)
    {
        $event = Event::create($request->validated());
        $this->uploadImage($event);
    }

    // Event Show
    public function showEvent(Event $event)
    {
        return compact('event');
    }

    // Event Edit
    public function editEvent(Event $event)
    {
        $galleries = Cache::get('galleries', Gallery::latest()->get());

        return compact('event', 'galleries');
    }

    // Event Update
    public function updateEvent(EventRequest $request, Event $event)
    {
        $event->update($request->validated());
        $this->uploadImage($event);
    }

    // Event Destroy
    public function destroyEvent(Event $event)
    {
        isset($event->image) ? $event->hardDelete('image') : '';
        $event->delete();
    }

    // Upload Image
    protected function uploadImage(Event $event)
    {
        if (request()->image) {
            $thumbnails = [
                'storage' => 'website/event/' . validImageFolder($event->id, 'event'),
                'width' => '1200',
                'height' => '630',
                'quality' => '100',
                'thumbnails' => [
                    [
                        'thumbnail-name' => 'medium',
                        'thumbnail-width' => '730',
                        'thumbnail-height' => '500',
                        'thumbnail-quality' => '90',
                    ],
                    [
                        'thumbnail-name' => 'small',
                        'thumbnail-width' => '80',
                        'thumbnail-height' => '70',
                        'thumbnail-quality' => '70',
                    ],
                ],
            ];
            $event->makeThumbnail('image', $thumbnails);
        }
    }
}

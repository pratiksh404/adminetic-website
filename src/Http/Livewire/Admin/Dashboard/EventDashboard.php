<?php

namespace Adminetic\Website\Http\Livewire\Admin\Dashboard;

use Livewire\Component;
use Adminetic\Website\Models\Admin\Event;

class EventDashboard extends Component
{
    public $event;
    public function mount(Event $event)
    {
        $this->event = $event;
    }
    public function render()
    {
        return view('website::livewire.admin.dashboard.event-dashboard');
    }
}

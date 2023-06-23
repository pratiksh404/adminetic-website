<?php

namespace Adminetic\Website\Http\Livewire\Admin\Dashboard;

use Adminetic\Website\Models\Admin\Event;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class WebsiteDashboard extends Component
{
    public $events;

    public function mount()
    {
        $this->events = Cache::get('events', Event::orderBy('position')->get());
    }

    public function render()
    {
        return view('website::livewire.admin.dashboard.admin-dashboard');
    }
}

<?php

namespace Adminetic\Website\Http\Livewire\Admin\Dashboard;

use Livewire\Component;
use Adminetic\Website\Models\Admin\Event;
use Illuminate\Support\Facades\Cache;

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

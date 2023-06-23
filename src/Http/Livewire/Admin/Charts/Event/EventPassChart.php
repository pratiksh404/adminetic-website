<?php

namespace Adminetic\Website\Http\Livewire\Admin\Charts\Event;

use Adminetic\Website\Models\Admin\Event;
use Adminetic\Website\Models\Admin\Pass;
use Adminetic\Website\Services\Statistic;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class EventPassChart extends Component
{
    public $event;
    public $passes;
    public $chart = 1; // 1 = Area | 2 = Bar
    public $per = 1; // 1 = Day | 2 = Month

    protected $listeners = ['initialize_event_pass_chart' => 'initializeEventPassChart'];

    public function mount($event = null)
    {
        $this->event = $event;
        $this->passes = ! is_null($event) ? $event->passes : Pass::orderBy('position')->get();
    }

    public function initializeEventPassChart()
    {
        $passes = $this->passes;
        $total_pass_limit = ! is_null($this->event) ? $this->event->total_limit : (Cache::get('events', Event::orderBy('position')->get()))->reduce(function (int $total, $event) {
            return $total + $event->total_limit;
        }, 0);
        $total_registered_pass = ! is_null($this->event) ? $this->event->passes->count() : Pass::count();
        $total_remaining_pass = $total_pass_limit - $total_registered_pass;
        $this->dispatchBrowserEvent('initializeEventPassChart', [
            'passRegisterPerDay' => (new Statistic)->passRegisterPerDay($passes),
            'total_pass' => $total_pass_limit,
            'total_registered_pass' => $total_registered_pass,
            'total_remaining_pass' => $total_remaining_pass,
        ]);
    }

    public function render()
    {
        return view('website::livewire.admin.charts.event.event-pass-chart');
    }
}

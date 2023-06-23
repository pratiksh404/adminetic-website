<?php

namespace Adminetic\Website\Http\Livewire\Admin\Charts\Event;

use Adminetic\Website\Models\Admin\Payment;
use Adminetic\Website\Services\Statistic;
use Livewire\Component;

class EventPaymentChart extends Component
{
    public $event;
    public $payments;
    public $chart = 1; // 1 = Area | 2 = Bar
    public $per = 1; // 1 = Day | 2 = Month

    protected $listeners = ['initialize_event_payment_chart' => 'initializeEventPaymentChart'];

    public function mount($event = null)
    {
        $this->event = $event;
        $this->payments = ! is_null($event) ? $event->payments : Payment::orderBy('position')->get();
    }

    public function initializeEventPaymentChart()
    {
        $payments = $this->payments;
        $this->dispatchBrowserEvent('initializeEventPaymentChart', (new Statistic)->perDayPaymentTotal($payments));
    }

    public function render()
    {
        return view('website::livewire.admin.charts.event.event-payment-chart');
    }
}

<?php

namespace Adminetic\Website\Http\Livewire\Admin\Payment;

use Adminetic\Website\Exports\Payment\DateWisePaymentExport;
use Adminetic\Website\Exports\Payment\PaymentGeneralExport;
use Adminetic\Website\Exports\Payment\TypeWisePaymentExport;
use Adminetic\Website\Models\Admin\Event;
use Adminetic\Website\Models\Admin\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PaymentMaster extends Component
{
    use WithPagination;

    public $payments;

    /*
    |--------------------------------------------------------------------------
    | Payment Date Mode
    |--------------------------------------------------------------------------
    |
    | 1 = Date Mode
    | 2 = Date Range Mode
    |
    */
    public $date_mode = 1;

    public $date;
    public $start_date;
    public $end_date;

    /*
    |--------------------------------------------------------------------------
    | Payment Type
    |--------------------------------------------------------------------------
    |
    | 1 => Income
    | 2 => Expense
    |
    */
    public $payment_type;

    /*
    |--------------------------------------------------------------------------
    | Event ID Filter
    |--------------------------------------------------------------------------
    */
    public $events;
    public $event_id;

    /*
    |--------------------------------------------------------------------------
    | Order By
    |--------------------------------------------------------------------------
    |
    | 1 = Latest
    | 2 = Oldest
    |
    */
    public $order_by;

    protected $listeners = ['initialize_payment_master' => 'initializePaymentMaster', 'filter_date' => 'filterDate', 'date_range_filter' => 'dateRangeFilter'];

    public function initializePaymentMaster()
    {
        $this->emit('initializePaymentMaster');
    }

    public function updatedDateMode()
    {
        $this->emit('initializePaymentMaster');
    }

    public function dateRangeFilter($start_date, $end_date)
    {
        $this->date_mode = 2;
        $this->start_date = Carbon::create($start_date);
        $this->end_date = Carbon::create($end_date);
        $this->getPayments();
        $this->emit('initializePaymentMaster');
    }

    public function filterDate($date)
    {
        $this->date_mode = 1;
        $this->date = Carbon::create($date);
        $this->getPayments();
        $this->emit('initializePaymentMaster');
    }

    public function updatedEventId()
    {
        $this->getPayments();
        $this->emit('initializePaymentMaster');
    }

    public function mount()
    {
        $this->getPayments();
        $this->events = Cache::get('events', Event::orderBy('position')->get());
    }

    public function render()
    {
        return view('website::livewire.admin.payment.payment-master');
    }

    public function resetFilter()
    {
        $this->order_by = null;
        $this->payment_type = null;
        $this->date_mode = null;
        $this->date = null;
        $this->start_date = null;
        $this->end_date = null;
    }

    public function getPayments()
    {
        $data = Payment::query();

        $data = $this->filterByEventId($data);

        $data = $this->filterByPaymentType($data);

        $data = $this->filterByDateMode($data);

        $data = $this->orderPayments($data);

        $this->payments = $data->get();
    }

    private function filterByEventId($data)
    {
        if (! is_null($this->event_id)) {
            $event = Event::find($this->event_id);

            return $data->whereIn('id', $event->payments->pluck('id'));
        }

        return $data;
    }

    private function filterByPaymentType($data)
    {
        $payment_type = $this->payment_type;
        if (! is_null($payment_type)) {
            return $data->where('type', $payment_type);
        }

        return $data;
    }

    private function filterByDateMode($data)
    {
        $date_mode = $this->date_mode;
        if (! is_null($date_mode)) {
            if ($date_mode == 1) {
                $date = $this->date ?? Carbon::now();

                return $data->whereDate('created_at', $date);
            }
            if ($date_mode == 2) {
                $start_date = $this->start_date;
                $end_date = $this->end_date;
                if (! is_null($start_date) && ! is_null($end_date)) {
                    return $data->whereBetween('created_at', [$start_date, $end_date]);
                }
            }

            return $data;
        }

        return $data;
    }

    private function orderPayments($data)
    {
        $order_by = $this->order_by;

        if (! is_null($order_by)) {
            if ($order_by == 1) {
                return $data->latest();
            } elseif ($order_by == 2) {
                return $data->oldest();
            }
        }

        return $data;
    }

    /* Export */
    public function export($type)
    {
        $payments = Payment::get();
        // General Export
        if ($type == 1) {
            return Excel::download(new PaymentGeneralExport($payments), 'payment_general_export.xlsx');
        }
        // Date Wise Payment Export
        elseif ($type == 2) {
            return Excel::download(new DateWisePaymentExport($payments), 'payment_datewise_export.xlsx');
        }
        // Payment Type Export
        elseif ($type == 3) {
            return Excel::download(new TypeWisePaymentExport($payments), 'type_wise_payment_export.xlsx');
        }
    }
}

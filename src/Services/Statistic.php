<?php

namespace Adminetic\Website\Services;

use Carbon\CarbonPeriod;
use Adminetic\Website\Models\Admin\Pass;
use Adminetic\Website\Models\Admin\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Statistic
{
    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */
    public function dayBook(Carbon $start_date, Carbon $end_date, $event = null)
    {
        $data = null;
        $period = CarbonPeriod::create($start_date, $end_date);
        foreach ($period as $date) {
            if (!is_null($event)) {
                $payments = $event->payments->filter(function ($payment) use ($date) {
                    return $payment->created_at->format('Y-m-d') == $date->format('Y-m-d');
                });
                $passes = $event->passes->filter(function ($pass) use ($date) {
                    return $pass->created_at->format('Y-m-d') == $date->format('Y-m-d');
                });
            } else {
                $payments = Payment::whereDate('created_at', $date)->get();
                $passes = Pass::whereDate('created_at', $date);
            }
            $data[modeDate($date)] = [
                'total_payment' => $payments->sum('payment'),
                'total_pass' => $passes->count(),
                'total_transaction' => $payments->count(),
            ];
        }

        return !is_null($data) ? array_reverse($data) : null;
    }
    /*
    |--------------------------------------------------------------------------
    | Pass Statistics
    |--------------------------------------------------------------------------
    */
    public function passRegisterPerDay($given_data = null, $limit = 30)
    {
        $data = $given_data ?? Pass::orderBy('position')->get();
        if ($data->count() > 0) {
            $data = $data->sortByDesc('created_at');
            $end_date = $data->first()->created_at;
            $start_date  = $end_date->copy()->subDays($limit);
            $period = CarbonPeriod::create($start_date, $end_date);
            $total = [];
            foreach ($period as $date) {
                $total[modeDate($date)] = $data->filter(function ($p) use ($date) {
                    return $p->created_at->format('Y-m-d') == $date->format('Y-m-d');
                })->count();
            }
            return $total;
        }
        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Payment Statistics
    |--------------------------------------------------------------------------
    */
    public function perDayPaymentTotal($given_data = null, $limit = 30)
    {
        $data = $given_data ?? Payment::orderBy('position')->get();
        if ($data->count() > 0) {
            $data = $data->sortByDesc('created_at');
            $end_date = $data->first()->created_at;
            $start_date  = $end_date->copy()->subDays($limit);
            $period = CarbonPeriod::create($start_date, $end_date);
            $total = [];
            foreach ($period as $date) {
                $total[modeDate($date)] = $data->filter(function ($p) use ($date) {
                    return $p->created_at->format('Y-m-d') == $date->format('Y-m-d');
                })->sum('payment');
            }
            return $total;
        }
        return  null;
    }
}

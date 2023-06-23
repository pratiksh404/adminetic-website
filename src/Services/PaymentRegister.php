<?php

namespace Adminetic\Website\Services;

use Adminetic\Website\Models\Admin\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentRegister
{
    protected $amount;

    protected $payment_id;

    public function __construct($amount, $payment_id = null)
    {
        $this->amount = $amount;
        $this->payment_id = $payment_id;

        if (! is_null($payment_id)) {
            Payment::where('payment_id', $payment_id)->delete();
        }
    }

    public function income($model, $given_particular = null)
    {
        $particular = $given_particular ?? (currency().$this->amount.' is issued by '.Auth::user()->name.' at '.Carbon::now()->toDateTimeString());
        $payment = $model->payments()->create([
            'user_id' => Auth::user()->id,
            'type' => 1,
            'amount' => $this->amount,
            'particular' => $particular,
        ]);

        // Notification
        notify('payment_issued', [
            'title' => 'Income : Payment Issued',
            'subject' => $particular,
            'message' => $particular.' related to '.class_basename($model).' of ID '.$model->id,
            'color' => 'success',
        ]);
    }

    public function expense($model, $given_particular = null)
    {
        $particular = $given_particular ?? (currency().$this->amount.' is issued by '.Auth::user()->name.' at '.Carbon::now()->toDateTimeString());
        $payment = Payment::create([
            'user_id' => Auth::user()->id,
            'type' => 2,
            'amount' => $this->amount,
            'particular' => $particular,
        ]);

        // Notification
        notify('payment_issued', [
            'title' => 'Expense : Payment Issued',
            'subject' => $particular,
            'message' => $particular.' related to '.class_basename($model).' of ID '.$model->id,
            'color' => 'danger',
        ]);
    }
}

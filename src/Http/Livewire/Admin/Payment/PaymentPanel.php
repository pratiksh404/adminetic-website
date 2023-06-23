<?php

namespace Adminetic\Website\Http\Livewire\Admin\Payment;

use Adminetic\Website\Models\Admin\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentPanel extends Component
{
    public $toggle_modal = false;


    public $model;
    public $type;

    public $amount;
    public $particular;

    public $payment_id;

    public function mount($model, $type)
    {
        $this->model = $model;
        $this->type = $type;
        $this->particular = ("An " . ($this->type ? "income" : "expense") . " of " . currency() . $this->amount . ' is registered under ' . class_basename($this->model) . ' : ' . $this->model->track_id);
    }

    public function updatedAmount()
    {
        $this->particular = ("An " . ($this->type ? "income" : "expense") . " of " . currency() . $this->amount . ' is registered under ' . class_basename($this->model) . ' : ' . $this->model->track_id);
    }

    public function store()
    {
        $this->validate([
            'amount' => 'required|numeric'
        ]);

        $particular = $this->particular ?? ("An " . ($this->type ? "income" : "expense") . " of " . currency() . $this->amount . ' is registered under ' . class_basename($this->model) . ' : ' . $this->model->track_id);

        $this->model->payments()->create([
            'user_id' => Auth::user()->id,
            'type' => $this->type,
            'amount' => $this->amount,
            'particular' => $particular
        ]);
        $this->amount = null;

        $this->model->refresh();
        $this->emitSelf('payment_success', $particular);
    }

    public function update()
    {
        $this->validate([
            'amount' => 'required|numeric'
        ]);

        $particular = $this->particular ?? ("An " . ($this->type ? "income" : "expense") . " of " . currency() . $this->amount . ' is registered under ' . class_basename($this->model) . ' : ' . $this->model->track_id . '(Updated)');

        Payment::find($this->payment_id)->update([
            'user_id' => Auth::user()->id,
            'type' => $this->type,
            'amount' => $this->amount,
            'particular' => $particular
        ]);
        $this->amount = null;
        $this->payment_id = null;

        $this->model->refresh();
        $this->emitSelf('payment_success', $particular);
    }

    public function setEdit(Payment $payment)
    {
        $this->payment_id = $payment->id;
        $this->amount = $payment->amount;
    }

    public function render()
    {
        $payments = $this->model->payments;
        return view('website::livewire.admin.payment.payment-panel', compact('payments'));
    }
}

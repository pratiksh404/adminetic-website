<div class="row">
    <div class="col-12">
        <div class="input-group">
            <span class="input-group-text">{{ $payment->type ?? 'Expense' }}</span>
            <input type="number" name="amount" id="amount" class="form-control"
                value="{{ $payment->amount ?? old('amount') }}" placeholder="{{ $payment->type ?? 'Expense' }} Amount">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <label for="particular">Particular</label>
        <textarea class="form-control" name="particular" id="particular" cols="30" rows="10">{{ $payment->particular ?? old('particular') }}</textarea>
    </div>
</div>
<br>
<x-adminetic-edit-add-button :model="$payment ?? null" name="{{ $payment->type ?? 'Expense' }}" />

<div>
    <button class="btn btn-primary btn-air-primary" wire:click="$toggle('toggle_modal')">Payments</button>
    @if ($toggle_modal)
        <div class="card"
            style="position: fixed;top: 10vh;right: 15vw;bottom: 0;left: 15vw;z-index: 999;width: 70vw;height: fit-content;">
            <div class="card-header">
                <h5 class="card-title text-center">Payment Panel Of <b>{{ class_basename($model) }} :
                        {{ $model->mark ?? $model->track_id }}</b></h5>
            </div>
            <div class="card-body shadow-lg p-3">

                {{-- Payment Edit Mode --}}
                @if (!is_null($payment_id))
                    <form wire:submit.prevent="update">
                        <div class="input-group">
                            <span class="input-group-text">{{ currency() }}</span>
                            <input type="number" wire:model="amount" class="form-control" step="any">
                            <span class="input-group-text"><button type="submit"
                                    class="btn btn-primary btn-air-primary">Edit</button></span>
                        </div>
                        @error('amount')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                        <label>Particular</label>
                        <br>
                        <div class="input-group">
                            <textarea wire:model="particular" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        @error('particular')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </form>
                @else
                    {{-- Payment Register Mode --}}
                    <form wire:submit.prevent="store">
                        <div class="input-group">
                            <span class="input-group-text">{{ currency() }}</span>
                            <input type="number" wire:model="amount" class="form-control" step="any">
                            <span class="input-group-text"><button type="submit"
                                    class="btn btn-primary btn-air-primary">Submit</button></span>
                        </div>
                        @error('amount')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                        <label>Particular</label>
                        <br>
                        <div class="input-group">
                            <textarea wire:model="particular" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        @error('particular')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </form>
                @endif
                @if ($model->payments->count() > 0)
                    <hr>
                    <div class="card">
                        <div class="card-body shadow-lg p-2">
                            <div class="row">
                                <div class="col-4">Particular</div>
                                <div class="col-2">Payment Of</div>
                                <div class="col-2">Amount : <b>{{ currency() . $model->payments->sum('amount') }}</b>
                                </div>
                                <div class="col-1">Type</div>
                                <div class="col-2">Date</div>
                                <div class="col-1">Edit</div>
                            </div>
                            @foreach ($model->payments as $payment)
                                <div class="row mt-3">
                                    <div class="col-4">{{ $payment->particular }}</div>
                                    <div class="col-2"><b> {{ class_basename($payment->paymentable) }}
                                            :
                                        </b>{{ $payment->paymentable->mark ?? $payment->paymentable->id }}
                                    </div>
                                    <div class="col-2"><span
                                            class="text-{{ $payment->getTypeColor() }}">{{ currency() . $payment->amount }}</span>
                                    </div>
                                    <div class="col-1"><span
                                            class="badge badge-{{ $payment->getTypeColor() }}">{{ $payment->type }}</span>
                                    </div>
                                    <div class="col-2">{{ $payment->created_at->toDateTimeString() }}
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-warning btn-air-warning btn-sm p-2"
                                            wire:click="setEdit({{ $payment->id }})"><i
                                                class="fa fa-edit"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
            <div class="card-footer shadow-lg d-flex justify-content-end">
                <button type="button" class="btn btn-danger btn-air-danger"
                    wire:click="$toggle('toggle_modal')">Close</button>
            </div>
        </div>
    @endif
    @push('livewire_third_party')
        <script>
            Livewire.on('payment_success', message => {
                var notify_allow_dismiss = Boolean(
                    {{ config('adminetic.notify_allow_dismiss', true) }});
                var notify_delay = {{ config('adminetic.notify_delay', 2000) }};
                var notify_showProgressbar = Boolean(
                    {{ config('adminetic.notify_showProgressbar', true) }});
                var notify_timer = {{ config('adminetic.notify_timer', 300) }};
                var notify_newest_on_top = Boolean(
                    {{ config('adminetic.notify_newest_on_top', true) }});
                var notify_mouse_over = Boolean(
                    {{ config('adminetic.notify_mouse_over', true) }});
                var notify_spacing = {{ config('adminetic.notify_spacing', 1) }};
                var notify_notify_animate_in =
                    "{{ config('adminetic.notify_animate_in', 'animated fadeInDown') }}";
                var notify_notify_animate_out =
                    "{{ config('adminetic.notify_animate_out', 'animated fadeOutUp') }}";
                var notify = $.notify({
                    title: "<i class='{{ config('adminetic.notify_icon', 'fa fa-bell-o') }}'></i> " +
                        "Alert",
                    message: message
                }, {
                    type: 'success',
                    allow_dismiss: notify_allow_dismiss,
                    delay: notify_delay,
                    showProgressbar: notify_showProgressbar,
                    timer: notify_timer,
                    newest_on_top: notify_newest_on_top,
                    mouse_over: notify_mouse_over,
                    spacing: notify_spacing,
                    animate: {
                        enter: notify_notify_animate_in,
                        exit: notify_notify_animate_out
                    }
                });
            });
        </script>
    @endpush
</div>

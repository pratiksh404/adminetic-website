<div>
    <div>
        <div class="card">
            <div class="card-body p-0">
                <div class="row chat-box">
                    <div class="col pe-0 custom-scrollbar"{{--  style="overflow: auto;height: 75vh;" --}}>
                        <!-- chat start-->
                        <div class="chat">

                            <div class="chat-msg-box custom-scrollbar">
                                {{-- Action Section --}}
                                <div class="card">
                                    <div class="card-body p-4">

                                        {{-- Filter --}}
                                        <ul class="chat-menu-icons">
                                            <li class="list-inline-item toogle-bar"><a
                                                    class="btn btn-primary btn-air-primary m-1" href="#"
                                                    title="Toggle Filter"><i class="icon-menu"></i> Menu</a>
                                            </li>
                                            <li> <b>Payment Master</b></li>

                                        </ul>
                                        <br>
                                    </div>
                                </div>
                                {{-- Shipment List --}}
                                <div class="card">
                                    <div class="card-body shadow-lg p-3">
                                        @if (!is_null($payments))
                                            @if ($payments->count() > 0)
                                                <div id="printContainer" class="printContainer">
                                                    <style>
                                                        table,
                                                        th,
                                                        td {

                                                            border: 1px solid #aaaaaa;
                                                            padding-left: 1px !important;
                                                            padding-right: 1px !important;
                                                            text-align: center;
                                                            border-spacing: 0;
                                                            font-family: Arial !important;
                                                        }

                                                        @page {
                                                            size: A4;
                                                            size: 210mm 297mm;
                                                            margin: 6mm 3mm 3mm 3mm;
                                                        }

                                                        .result-header {
                                                            padding: 1mm 2mm;
                                                            margin-bottom: 15px;
                                                            position: relative;
                                                        }

                                                        .result-header .s-logo {
                                                            background: none;
                                                            width: 3cm;
                                                            position: absolute;
                                                            top: 25px;
                                                            left: 18px;
                                                            border: none !important;

                                                        }

                                                        .result-header .s-logo img {
                                                            width: 77px;
                                                            border: none !important;
                                                        }

                                                        .result-header .school-desc {
                                                            width: auto;
                                                            margin-top: 10px;
                                                        }
                                                    </style>

                                                    <div class="content-wrapper">
                                                        <section class="content-header">
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <!--<div class="box" style="height:670px;overflow:scroll">-->
                                                                    <div class="box" style="padding: 20px">
                                                                        <div class="box-header">
                                                                        </div><!-- /.box-header -->
                                                                        <div class="box-body">
                                                                            <style>
                                                                                @media print {
                                                                                    .hide-print {
                                                                                        display: none !important;
                                                                                    }

                                                                                    table {
                                                                                        border-collapse: collapse;
                                                                                        border: 1px solid #777;
                                                                                    }

                                                                                    td,
                                                                                    th {
                                                                                        border: 1px solid #777;
                                                                                        padding: 2px 6px !important;
                                                                                        font-size: 8px;
                                                                                    }

                                                                                    h6,
                                                                                    span {
                                                                                        font-size: 10px;
                                                                                    }

                                                                                    h5 {
                                                                                        font-size: 13px;
                                                                                    }

                                                                                    h3 {
                                                                                        font-size: 15px;
                                                                                    }

                                                                                    .result-header {
                                                                                        line-height: 0px
                                                                                    }
                                                                                }
                                                                            </style>
                                                                            <header class="result-header"
                                                                                style="text-align: center;line-height: 2px">
                                                                                <div class=" s-logo">
                                                                                    <img src="{{ logo() }}"
                                                                                        width="200"
                                                                                        alt="{{ title() }}">
                                                                                </div>
                                                                                <div class="school-desc"
                                                                                    style="text-align: center">
                                                                                    <h3 class="uppercase font-bold">
                                                                                        {{ title() }}
                                                                                    </h3>
                                                                                </div>
                                                                            </header>
                                                                            <div
                                                                                style="text-align: center;margin-top: 20px;margin-bottom: 20px;line-height: 15px">
                                                                                <h5>Payments

                                                                                </h5>
                                                                            </div>
                                                                            <table class="display nowrap"
                                                                                style="width: 100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Particular</th>
                                                                                        <th>Payment Of</th>
                                                                                        <th>Amount :
                                                                                            <b>{{ currency() . $payments->sum('amount') }}</b>
                                                                                        </th>
                                                                                        <th>Type</th>
                                                                                        <th>Date</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($payments as $payment)
                                                                                        <tr>
                                                                                            <td>
                                                                                                <a href="{{ adminEditRoute('payment', $payment->id) }}"
                                                                                                    target="_blank">
                                                                                                    {{ $payment->particular }}
                                                                                                </a>
                                                                                            </td>
                                                                                            <td><b> {{ !is_null($payment->paymentable) ? class_basename($payment->paymentable) : '-' }}
                                                                                                    :
                                                                                                </b>{{ $payment->paymentable->mark ?? ($payment->paymentable->id ?? '-') }}
                                                                                            </td>
                                                                                            <td><span
                                                                                                    class="text-{{ $payment->getTypeColor() }}">{{ currency() . $payment->amount }}</span>
                                                                                            </td>
                                                                                            <td><span
                                                                                                    class="badge badge-{{ $payment->getTypeColor() }}">{{ $payment->type }}</span>
                                                                                            </td>
                                                                                            <td>{{ $payment->created_at->toDateTimeString() }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div><!-- /.box-body -->
                                                                    </div><!-- /.box -->
                                                                </div><!-- /.col -->
                                                            </div><!-- /.row -->
                                                        </section>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-center">
                                                    <img src="{{ asset('adminetic/static/not_found.gif') }}"
                                                        alt="No Payment Found" class="img-fluid">
                                                </div>
                                            @endif
                                        @else
                                            <div class="d-flex justify-content-center">
                                                <img src="{{ asset('adminetic/static/onloading.gif') }}"
                                                    alt="No Payment" class="img-fluid">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col ps-0 chat-menu" style="max-width: 500px;">
                        <div class="card">
                            <div class="card-body shadow-lg p-1">
                                <div style="height: 65vh;overflow-y: auto; padding: 10px">
                                    <div id="filters">
                                        <a href="{{ adminCreateRoute('payment') }}"
                                            class="btn btn-primary btn-air-primary" style="width:100%">Add Expense</a>
                                        <hr>
                                        <div class="btn-group" role="group" wire:loading.remove wire:target="export"
                                            style="width:100%">
                                            <button class="btn btn-success btn-air-success dropdown-toggle"
                                                id="exportGroup" type="button" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">Export</button>
                                            <div class="dropdown-menu" aria-labelledby="exportGroup"><a
                                                    class="dropdown-item" href="#" wire:click="export(1)">General
                                                    Export</a>
                                                <a class="dropdown-item" href="#" wire:click="export(2)">Date Wise
                                                    Payment Export</a>
                                                <a class="dropdown-item" href="#" wire:click="export(3)">Type Wise
                                                    Payment Export</a>
                                            </div>
                                        </div>
                                        <div wire:loading wire:target="export">
                                            <button class="btn btn-success btn-air-success" disabled>Exporting
                                                ....</button>
                                        </div>
                                        <hr>
                                        <button class="btn btn-secondary btn-air-secondary" style="width: 100%"
                                            wire:click="resetFilter">Reset</button>
                                        <hr>
                                        @if ($events->count() > 0)
                                            <label>Event </label> <br>
                                            <div class="input-group">
                                                <select id="events" class="form-control">
                                                    <option value="">Select ... </option>
                                                    @foreach ($events as $event)
                                                        <option value="{{ $event->id }}">
                                                            {{ $event->mark }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>
                                        @endif
                                        <div class="input-group">
                                            <span class="input-group-text">Order By</span>
                                            <select wire:model="order_by" class="form-control">
                                                <option value="">Select ... </option>
                                                <option value="1">Latest</option>
                                                <option value="2">Oldest</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-text">Type</span>
                                            <select wire:model="payment_type" class="form-control">
                                                <option value="">Select ... </option>
                                                <option value="1">Income</option>
                                                <option value="2">Expense</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-text">Get Payment</span>
                                            <select wire:model="date_mode" class="form-control">
                                                <option value="">Select ..</option>
                                                <option value="1">Date</option>
                                                <option value="3">Date Range</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            @if ($date_mode == 1)
                                                <input type="text" id="date" class="form-control">
                                            @else
                                                <input type="text" id="interval" class="form-control">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('livewire_third_party')
            <script>
                $(function() {
                    Livewire.emit('initialize_payment_master');
                    Livewire.on('initializePaymentMaster', function() {
                        initializePaymentMaster();
                    });

                    function initializePaymentMaster() {
                        $('#events').select2();
                        $('#events').on('change', function(e) {
                            var data = $('#events').select2("val");
                            @this.set('event_id', data);
                        });

                        $('#date').daterangepicker({
                            singleDatePicker: true,
                            locale: {
                                cancelLabel: 'Clear'
                            }
                        });


                        $('#date').on('apply.daterangepicker', function(ev, picker) {
                            let date = new Date($('#date').data('daterangepicker')
                                .startDate.format('YYYY-MM-DD'));
                            window.livewire.emit('filter_date', date)
                        });

                        $('#date').on('cancel.daterangepicker', function(ev, picker) {
                            $(this).val('');
                        });

                        $('#interval').daterangepicker({
                            locale: {
                                cancelLabel: 'Clear'
                            }
                        });

                        $('#interval').on('apply.daterangepicker', function(ev, picker) {
                            let start_date = new Date($('#interval').data('daterangepicker')
                                .startDate.format('YYYY-MM-DD'));
                            let end_date = new Date($('#interval').data('daterangepicker').endDate
                                .format('YYYY-MM-DD'));
                            window.livewire.emit('date_range_filter', start_date, end_date)
                        });

                        $('#interval').on('cancel.daterangepicker', function(ev, picker) {
                            $(this).val('');
                        });
                    }
                });
            </script>
        @endpush
    </div>
</div>

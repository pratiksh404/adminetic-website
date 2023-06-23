<div>
    @if ($chart == 1)
        <span class="text-center">Payments</span>
        <div id="eventPaymentAreaChart"></div>
    @endif
    @if ($chart == 2)
        <span class="text-center">Payments</span>
        <div id="eventPaymentBarChart"></div>
    @endif
    @push('livewire_third_party')
        @include('website::admin.layouts.modules.event.livewire_scripts.chart.event-payment-chart-script')
    @endpush
</div>

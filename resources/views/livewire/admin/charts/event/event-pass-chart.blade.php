<div>
    <div class="row">
        <div class="col-lg-8">
            @if ($chart == 1)
                <span class="text-center">Passes</span>
                <div id="eventPassAreaChart"></div>
            @endif
            @if ($chart == 2)
                <span class="text-center">Passes</span>
                <div id="eventPassBarChart"></div>
            @endif
        </div>
        <div class="col-lg-4">
            <div id="totalVsRemainingEventPassPieChart"></div>
        </div>
    </div>
    @push('livewire_third_party')
        @include('website::admin.layouts.modules.event.livewire_scripts.chart.event-pass-chart-script')
    @endpush
</div>

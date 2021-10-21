@if (config('website.google_analytics_active',false))
<div class="row">
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="input-group">
                    <span class="input-group-text">Views in</span>
                    <input type="number" id="viewByCountryColumnChartDays" class="form-control" value="7" max="30">
                    <span class="input-group-text">days.</span>
                    <span class="input-group-text"><button type="button" class="btn btn-primary"
                            id="generateViewByCountryColumnChart">Generate</button></span>
                </div>
                <div id="viewByCountryColumnChart"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="input-group">
                    <span class="input-group-text">Views in</span>
                    <input type="number" id="viewByDaysColumnChartDays" class="form-control" value="7" max="30">
                    <span class="input-group-text">days.</span>
                    <span class="input-group-text"><button type="button" class="btn btn-primary"
                            id="generateViewByDaysColumnChart">Generate</button></span>
                </div>
                <div id="viewByDaysColumnChart"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="input-group">
                    <span class="input-group-text">Referrers in</span>
                    <input type="number" id="topReferrersColumnChartDays" class="form-control" value="7" max="30">
                    <span class="input-group-text">days.</span>
                    <span class="input-group-text"><button type="button" class="btn btn-primary"
                            id="generateTopReferrersColumnChart">Generate</button></span>
                </div>
                <div id="topReferrersColumnChart"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="input-group">
                    <span class="input-group-text">Statistics in</span>
                    <input type="number" id="newVsReturningVistorPieChartDays" class="form-control" value="7" max="30">
                    <span class="input-group-text">days.</span>
                    <span class="input-group-text"><button type="button" class="btn btn-primary"
                            id="generateNewVsReturningVistorPieChart">Generate</button></span>
                </div>
                <div id="newVsReturningVistorPieChart"></div>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-body p-3">
                @livewire('admin.analytics.top-exit-pages')
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="input-group">
                    <span class="input-group-text">Views in</span>
                    <input type="number" id="mostVisitedPagesBarChartDays" class="form-control" value="7" max="30">
                    <span class="input-group-text">days.</span>
                    <span class="input-group-text"><button type="button" class="btn btn-primary"
                            id="generateMostVisitedPagesBarChart">Generate</button></span>
                </div>
                <div id="mostVisitedPagesBarChart"></div>
            </div>
        </div>
        @isset($top_keywords)
        @if (count($top_keywords) > 0)
        <div class="card shadow-lg">
            <div class="card-body p-2">
                <b class="text-center">Top Keywords :- </b> <br>
                @foreach ($top_keywords as $top_keyword)
                <span class="badge badge-primary m-1">
                    <b>Keyword : </b>{{$top_keyword[0] ?? 'N/A'}}
                    <br>
                    <b>Sessions : </b>{{$top_keyword[1] ?? 'N/A'}}
                </span>
                @endforeach
            </div>
        </div>
        @endif
        @endisset
        @livewire('admin.analytics.duration-spend-on-site')
    </div>
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="input-group">
                    <span class="input-group-text">Sessions in</span>
                    <input type="number" id="topBrowsersPieChartDays" class="form-control" value="7" max="30">
                    <span class="input-group-text">days.</span>
                    <span class="input-group-text"><button type="button" class="btn btn-primary"
                            id="generateTopBrowsersPieChart">Generate</button></span>
                </div>
                <div id="topBrowsersPieChart"></div>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-body p-3">
                @livewire('admin.analytics.top-landing-pages')
            </div>
        </div>
    </div>
</div>
@endif
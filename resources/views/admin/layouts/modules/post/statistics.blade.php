<div class="row">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ views($post)->count() }}</h3>
                <span>Total Views</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ views($post)->period(\CyrildeWit\EloquentViewable\Support\Period::pastWeeks(1))->count() }}
                </h3>
                <span>This Week Views</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ views($post)->period(\CyrildeWit\EloquentViewable\Support\Period::pastMonths(1))->count() }}
                </h3>
                <span>This Month Views</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ views($post)->period(\CyrildeWit\EloquentViewable\Support\Period::pastYears(1))->count() }}
                </h3>
                <span>This Year Views</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <!-- Line Basic Chart Start -->
        <div class="card">
            <div class="card-body">
                <div class="card-title">Monthly Views Line Chart</div>
                <div id="monthly-post-views-line-chart" data-id="{{ $post->id }}"></div>
            </div>
        </div>
        <!-- line basic chart end -->
    </div>
    <div class="col-lg-6">
        <!-- Line Basic Chart Start -->
        <div class="card">
            <div class="card-body">
                <div class="card-title">Monthly Views Bar Chart</div>
                <div id="monthly-post-views-bar-chart" data-id="{{ $post->id }}"></div>
            </div>
        </div>
        <!-- line basic chart end -->
    </div>
</div>
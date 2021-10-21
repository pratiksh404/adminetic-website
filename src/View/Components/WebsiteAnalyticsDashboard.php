<?php

namespace Adminetic\Website\View\Components;

use Analytics;
use Spatie\Analytics\Period;
use Illuminate\View\Component;

class WebsiteAnalyticsDashboard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $top_keywords = Analytics::performQuery(
            Period::days(request()->has('days') ? (int) request()->days : 7),
            'ga:keyword',
            [
                'dimensions' => 'ga:keyword',
                'metrics' => 'ga:sessions',
                'sort' => '-ga:sessions'
            ]
        )->rows;

        return view('website::components.website-analytics-dashboard', compact('top_keywords'));
    }
}

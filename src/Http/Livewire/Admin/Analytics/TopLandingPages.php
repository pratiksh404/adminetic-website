<?php

namespace Adminetic\Website\Http\Livewire\Admin\Analytics;

use Analytics;
use Spatie\Analytics\Period;
use Livewire\Component;

class TopLandingPages extends Component
{
    public $days = 3;

    public function render()
    {
        $top_landing_pages = Analytics::performQuery(
            Period::days($this->days),
            'ga:entrances',
            [
                'dimensions' => 'ga:landingPagePath',
                'metrics' => 'ga:entrances,ga:bounces',
                'sort' => '-ga:entrances'
            ]
        )->rows;

        return view('website::livewire.admin.analytics.top-landing-pages', compact('top_landing_pages'));
    }
}

<?php

namespace Adminetic\Website\Http\Livewire\Admin\Analytics;

use Analytics;
use Livewire\Component;
use Spatie\Analytics\Period;

class DurationSpendOnSite extends Component
{
    public $days = 7;

    public function render()
    {
        $site_durations = Analytics::performQuery(
            Period::days($this->days),
            'ga:sessionDuration',
            [
                'metrics' => 'ga:sessions,ga:sessionDuration',
            ]
        )->rows;

        return view('website::livewire.admin.analytics.duration-spend-on-site', compact('site_durations'));
    }
}

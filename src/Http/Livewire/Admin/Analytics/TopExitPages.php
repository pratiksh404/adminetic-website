<?php

namespace Adminetic\Website\Http\Livewire\Admin\Analytics;

use Analytics;
use Spatie\Analytics\Period;
use Livewire\Component;

class TopExitPages extends Component
{
    public $days = 3;

    public function render()
    {
        $top_exit_pages = Analytics::performQuery(
            Period::days($this->days),
            'ga:pageviews',
            [
                'dimensions' => 'ga:exitPagePath',
                'metrics' => 'ga:exits,ga:pageviews',
                'sort' => '-ga:exits'
            ]
        )->rows;

        return view('website::livewire.admin.analytics.top-exit-pages', compact('top_exit_pages'));
    }
}

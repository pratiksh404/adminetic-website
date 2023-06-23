<?php

namespace Adminetic\Website\Http\Livewire\Admin\Dashboard;

use Carbon\Carbon;
use Livewire\Component;

class NewsHeadline extends Component
{
    public $headline_news;

    public function mount()
    {
        $this->headline_news = auth()->user()->notifications->filter(function ($n) {
            return Carbon::now()->isSameDay($n->created_at);
        });
    }

    public function render()
    {
        return view('website::livewire.admin.dashboard.news-headline');
    }
}

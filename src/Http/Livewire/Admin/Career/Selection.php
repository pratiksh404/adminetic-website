<?php

namespace Adminetic\Website\Http\Livewire\Admin\Career;

use Adminetic\Website\Models\Admin\Application;
use Livewire\Component;

class Selection extends Component
{
    public $application;
    public $short_listed;
    public $selected;

    public function mount(Application $application)
    {
        $this->application = $application;
        $this->short_listed = $application->short_listed ?? false;
        $this->selected = $application->selected ?? false;
    }

    public function updatedShortListed()
    {
        $this->application->update([
            'short_listed' => $this->short_listed,
        ]);
    }

    public function updatedSelected()
    {
        $this->application->update([
            'selected' => $this->selected,
        ]);
    }

    public function render()
    {
        return view('website::livewire.admin.career.selection');
    }
}

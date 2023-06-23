<?php

namespace Adminetic\Website\Http\Livewire\Admin\Career;

use Adminetic\Website\Models\Admin\Career;
use Livewire\Component;

class Summary extends Component
{
    public $career_id;
    public $updateMode = false;
    public $removes = [];
    public $summary = [];
    public $i = 0;

    public function mount($career_id = null)
    {
        $this->career_id = $career_id;
        $career = Career::find($career_id);
        $this->i = isset($career->summary) ? count($career->summary) : 0;
        $this->summary = isset($career->summary) ? $career->summary : [];
    }

    public function add($i)
    {
        $i += 1;
        $this->i = $i;
    }

    public function remove($key)
    {
        array_push($this->removes, $key);
    }

    public function render()
    {
        return view('website::livewire.admin.career.summary');
    }
}

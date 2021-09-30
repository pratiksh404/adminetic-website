<?php

namespace Adminetic\Website\Http\Livewire\Admin\Team;

use Livewire\Component;
use Adminetic\Website\Models\Admin\Team;
use Illuminate\Support\Facades\Cache;

class ReorderTeam extends Component
{
    public function updateTeamOrder($lists)
    {
        foreach ($lists as $list) {
            Team::find($list['value'])->update(['position' => $list['order']]);
        }
        $this->emit('reorderingComplete');
    }

    public function render()
    {
        $teams = Cache::get('teams', Team::orderBy('position')->get());
        return view('website::livewire.admin.team.reorder-team', compact('teams'));
    }
}

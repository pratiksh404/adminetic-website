<?php

namespace App\Contracts;

use App\Models\Admin\Team;
use App\Http\Requests\TeamRequest;

interface TeamRepositoryInterface
{
    public function indexTeam();

    public function createTeam();

    public function storeTeam(TeamRequest $request);

    public function showTeam(Team $Team);

    public function editTeam(Team $Team);

    public function updateTeam(TeamRequest $request, Team $Team);

    public function destroyTeam(Team $Team);
}

<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Contracts\TeamRepositoryInterface;
use Adminetic\Website\Http\Requests\TeamRequest;
use Adminetic\Website\Models\Admin\Team;
use App\Http\Controllers\Controller;

class TeamRestAPIController extends Controller
{
    protected $teamRepositoryInterface;

    public function __construct(TeamRepositoryInterface $teamRepositoryInterface)
    {
        $this->teamRepositoryInterface = $teamRepositoryInterface;
        $this->authorizeResource(Team::class, 'team');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->teamRepositoryInterface->indexTeam(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\TeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        $team = $this->teamRepositoryInterface->storeTeam($request);

        return response()->json($team, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return response()->json($team, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\TeamRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, Team $team)
    {
        $this->teamRepositoryInterface->updateTeam($request, $team);

        return response()->json($team, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $deleted_item = $team;
        $team->delete();

        return response()->json($deleted_item, 200);
    }
}

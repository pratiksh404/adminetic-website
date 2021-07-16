<?php

namespace Adminetic\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Team;
use Adminetic\Website\Http\Requests\TeamRequest;
use Adminetic\Website\Contracts\TeamRepositoryInterface;


class TeamController extends Controller
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
        return view('website::admin.team.index', $this->teamRepositoryInterface->indexTeam());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\TeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        $this->teamRepositoryInterface->storeTeam($request);
        return redirect(adminRedirectRoute('team'))->withSuccess('Team Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return view('website::admin.team.show', $this->teamRepositoryInterface->showTeam($team));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('website::admin.team.edit', $this->teamRepositoryInterface->editTeam($team));
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
        return redirect(adminRedirectRoute('team'))->withInfo('Team Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $this->teamRepositoryInterface->destroyTeam($team);
        return redirect(adminRedirectRoute('team'))->withFail('Team Deleted Successfully.');
    }
}

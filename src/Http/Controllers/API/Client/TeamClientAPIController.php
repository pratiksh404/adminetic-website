<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Http\Resources\Team\TeamCollection;
use Adminetic\Website\Http\Resources\Team\TeamResource;
use Adminetic\Website\Models\Admin\Team;
use App\Http\Controllers\Controller;

class TeamClientAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TeamCollection(Team::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return new TeamResource($team);
    }
}

<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Models\Admin\Project;
use Adminetic\Website\Http\Resources\Project\ProjectCollection;
use Adminetic\Website\Http\Resources\Project\ProjectResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectClientAPIController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProjectCollection(Project::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }
}

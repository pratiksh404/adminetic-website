<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Models\Admin\Project;
use Adminetic\Website\Http\Requests\ProjectRequest;
use App\Http\Controllers\Controller;
use Adminetic\Website\Contracts\ProjectRepositoryInterface;

class ProjectRestAPIController extends Controller
{

    protected $projectRepositoryInterface;

    public function __construct(ProjectRepositoryInterface $projectRepositoryInterface)
    {
        $this->projectRepositoryInterface = $projectRepositoryInterface;
        $this->authorizeResource(Project::class, 'project');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->projectRepositoryInterface->indexProject(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = $this->projectRepositoryInterface->storeProject($request);
        return response()->json($project, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return response()->json($project, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ProjectRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $this->projectRepositoryInterface->updateProject($request, $project);
        return response()->json($project, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $deleted_item = $project;
        $project->delete();
        return response()->json($deleted_item, 200);
    }
}

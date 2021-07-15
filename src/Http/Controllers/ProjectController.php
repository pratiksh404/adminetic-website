<?php

namespace Adminetic\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Project;
use Adminetic\Website\Http\Requests\ProjectRequest;
use Adminetic\Website\Contracts\ProjectRepositoryInterface;

class ProjectController extends Controller
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
        return view('admin.project.index', $this->projectRepositoryInterface->indexProject());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $this->projectRepositoryInterface->storeProject($request);
        return redirect(adminRedirectRoute('project'))->withSuccess('Project Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.project.show', $this->projectRepositoryInterface->showProject($project));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.project.edit', $this->projectRepositoryInterface->editProject($project));
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
        return redirect(adminRedirectRoute('project'))->withInfo('Project Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->projectRepositoryInterface->destroyProject($project);
        return redirect(adminRedirectRoute('project'))->withFail('Project Deleted Successfully.');
    }
}

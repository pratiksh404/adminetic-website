<?php

namespace App\Repositories;


use Illuminate\Support\Facades\Cache;
use Adminetic\Website\Models\Admin\Project;
use Adminetic\Website\Http\Requests\ProjectRequest;
use Adminetic\Website\Contracts\ProjectRepositoryInterface;

class ProjectRepository implements ProjectRepositoryInterface
{
    // Project Index
    public function indexProject()
    {
        $projects = config('coderz.caching', true)
            ? (Cache::has('projects') ? Cache::get('projects') : Cache::rememberForever('projects', function () {
                return Project::latest()->get();
            }))
            : Project::latest()->get();
        return compact('projects');
    }

    // Project Create
    public function createProject()
    {
        //
    }

    // Project Store
    public function storeProject(ProjectRequest $request)
    {
        Project::create($request->validated());
    }

    // Project Show
    public function showProject(Project $project)
    {
        return compact('project');
    }

    // Project Edit
    public function editProject(Project $project)
    {
        return compact('project');
    }

    // Project Update
    public function updateProject(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
    }

    // Project Destroy
    public function destroyProject(Project $project)
    {
        $project->delete();
    }
}

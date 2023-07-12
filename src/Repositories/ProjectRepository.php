<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\ProjectRepositoryInterface;
use Adminetic\Website\Http\Requests\ProjectRequest;
use Adminetic\Website\Models\Admin\Project;
use Illuminate\Support\Facades\Cache;

class ProjectRepository implements ProjectRepositoryInterface
{
    // Project Index
    public function indexProject()
    {
        $projects = config('adminetic.caching', true)
            ? (Cache::has('projects') ? Cache::get('projects') : Cache::rememberForever('projects', function () {
                return Project::orderBy('position')->get();
            }))
            : Project::orderBy('position')->get();

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
        $project = Project::create($request->validated());
        $this->uploadImage($project);
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
        $this->uploadImage($project);
    }

    // Project Destroy
    public function destroyProject(Project $project)
    {
        $project->delete();
    }

    // Upload Image
    private function uploadImage(Project $project)
    {
        if (request()->has('image')) {
            $project
                ->addFromMediaLibraryRequest(request()->image)
                ->toMediaCollection('image');
        }
        if (request()->has('icon_image')) {
            $project
                ->addFromMediaLibraryRequest(request()->icon_image)
                ->toMediaCollection('icon_image');
        }
    }
}

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
        isset($project->image) ? $project->hardDelete('image') : '';
        $project->delete();
    }

    // Upload Image
    protected function uploadImage(Project $project)
    {
        if (request()->image) {
            $thumbnails = [
                'storage' => 'website/project/' . validImageFolder($project->type, 'post'),
                'width' => '1200',
                'height' => '630',
                'quality' => '100',
                'thumbnails' => [
                    [
                        'thumbnail-name' => 'medium',
                        'thumbnail-width' => '600',
                        'thumbnail-height' => '315',
                        'thumbnail-quality' => '80',
                    ],
                    [
                        'thumbnail-name' => 'small',
                        'thumbnail-width' => '100',
                        'thumbnail-height' => '80',
                        'thumbnail-quality' => '50',
                    ],
                ],
            ];
            $project->makeThumbnail('image', $thumbnails);
        }
    }
}

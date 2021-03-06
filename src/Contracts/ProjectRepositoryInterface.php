<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\ProjectRequest;
use Adminetic\Website\Models\Admin\Project;

interface ProjectRepositoryInterface
{
    public function indexProject();

    public function createProject();

    public function storeProject(ProjectRequest $request);

    public function showProject(Project $Project);

    public function editProject(Project $Project);

    public function updateProject(ProjectRequest $request, Project $Project);

    public function destroyProject(Project $Project);
}

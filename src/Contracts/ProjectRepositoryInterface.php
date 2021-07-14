<?php

namespace App\Contracts;

use App\Models\Admin\Project;
use App\Http\Requests\ProjectRequest;

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

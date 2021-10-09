<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Models\Admin\Template;
use Adminetic\Website\Http\Requests\TemplateRequest;

interface TemplateRepositoryInterface
{
    public function indexTemplate();

    public function createTemplate();

    public function storeTemplate(TemplateRequest $request);

    public function showTemplate(Template $Template);

    public function editTemplate(Template $Template);

    public function updateTemplate(TemplateRequest $request, Template $Template);

    public function destroyTemplate(Template $Template);
}

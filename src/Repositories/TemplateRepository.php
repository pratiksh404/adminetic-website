<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\TemplateRepositoryInterface;
use Adminetic\Website\Http\Requests\TemplateRequest;
use Adminetic\Website\Models\Admin\Template;
use Illuminate\Support\Facades\Cache;

class TemplateRepository implements TemplateRepositoryInterface
{
    // Template Index
    public function indexTemplate()
    {
        $templates = config('adminetic.caching', true)
            ? (Cache::has('templates') ? Cache::get('templates') : Cache::rememberForever('templates', function () {
                return Template::latest()->get();
            }))
            : Template::latest()->get();

        return compact('templates');
    }

    // Template Create
    public function createTemplate()
    {
        //
    }

    // Template Store
    public function storeTemplate(TemplateRequest $request)
    {
        Template::create($request->validated());
    }

    // Template Show
    public function showTemplate(Template $template)
    {
        return compact('template');
    }

    // Template Edit
    public function editTemplate(Template $template)
    {
        return compact('template');
    }

    // Template Update
    public function updateTemplate(TemplateRequest $request, Template $template)
    {
        $template->update($request->validated());
    }

    // Template Destroy
    public function destroyTemplate(Template $template)
    {
        $template->delete();
    }
}

<?php

namespace Adminetic\Website\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Template;
use Adminetic\Website\Http\Requests\TemplateRequest;
use Adminetic\Website\Contracts\TemplateRepositoryInterface;

class TemplateController extends Controller
{
    protected $templateRepositoryInterface;

    public function __construct(TemplateRepositoryInterface $templateRepositoryInterface)
    {
        $this->templateRepositoryInterface = $templateRepositoryInterface;
        $this->authorizeResource(Template::class, 'template');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.template.index', $this->templateRepositoryInterface->indexTemplate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\TemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TemplateRequest $request)
    {
        $this->templateRepositoryInterface->storeTemplate($request);
        return redirect(adminRedirectRoute('template'))->withSuccess('Template Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        return view('website::admin.template.show', $this->templateRepositoryInterface->showTemplate($template));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        return view('website::admin.template.edit', $this->templateRepositoryInterface->editTemplate($template));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\TemplateRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(TemplateRequest $request, Template $template)
    {
        $this->templateRepositoryInterface->updateTemplate($request, $template);
        return redirect(adminRedirectRoute('template'))->withInfo('Template Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        $this->templateRepositoryInterface->destroyTemplate($template);
        return redirect(adminRedirectRoute('template'))->withFail('Template Deleted Successfully.');
    }

    /**
     *
     * Get Template
     *
     */
    public function get_template(Request $request)
    {
        $template = Template::find($request->template_id);
        return response()->json(['template' => $template], 200);
    }
}

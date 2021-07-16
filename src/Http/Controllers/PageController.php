<?php

namespace Adminetic\Website\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Page;
use Adminetic\Website\Http\Requests\PageRequest;
use Adminetic\Website\Contracts\PageRepositoryInterface;

class PageController extends Controller
{
    protected $pageRepositoryInterface;

    public function __construct(PageRepositoryInterface $pageRepositoryInterface)
    {
        $this->pageRepositoryInterface = $pageRepositoryInterface;
        $this->authorizeResource(Page::class, 'page');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.page.index', $this->pageRepositoryInterface->indexPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\PageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $this->pageRepositoryInterface->storePage($request);
        return redirect(adminRedirectRoute('page'))->withSuccess('Page Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('website::admin.page.show', $this->pageRepositoryInterface->showPage($page));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('website::admin.page.edit', $this->pageRepositoryInterface->editPage($page));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\PageRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $this->pageRepositoryInterface->updatePage($request, $page);
        return redirect(adminRedirectRoute('page'))->withInfo('Page Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $this->pageRepositoryInterface->destroyPage($page);
        return redirect(adminRedirectRoute('page'))->withFail('Page Deleted Successfully.');
    }

    /**
     *
     * Reorder Pages
     *
     */
    public function reorder_pages(Request $request)
    {
        foreach ($request->input('rows', []) as $row) {
            Page::find($row['id'])->update([
                'position' => $row['position']
            ]);
        }

        return response()->noContent();
    }
}

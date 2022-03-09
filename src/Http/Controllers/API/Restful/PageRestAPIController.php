<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Contracts\PageRepositoryInterface;
use Adminetic\Website\Http\Requests\PageRequest;
use Adminetic\Website\Models\Admin\Page;
use App\Http\Controllers\Controller;

class PageRestAPIController extends Controller
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
        return response()->json($this->pageRepositoryInterface->indexPage(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\PageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $page = $this->pageRepositoryInterface->storePage($request);

        return response()->json($page, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return response()->json($page, 200);
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

        return response()->json($page, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $deleted_item = $page;
        $page->delete();

        return response()->json($deleted_item, 200);
    }
}

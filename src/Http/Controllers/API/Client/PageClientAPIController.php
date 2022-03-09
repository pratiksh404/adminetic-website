<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Page;
use Adminetic\Website\Http\Resources\Page\PageResource;
use Adminetic\Website\Http\Resources\Page\PageCollection;

class PageClientAPIController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PageCollection(Page::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return new PageResource($page);
    }
}

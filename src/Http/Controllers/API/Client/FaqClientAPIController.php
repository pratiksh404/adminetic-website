<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Models\Admin\Faq;
use Adminetic\Website\Http\Resources\Faq\FaqCollection;
use Adminetic\Website\Http\Resources\Faq\FaqResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqClientAPIController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new FaqCollection(Faq::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return new FaqResource($faq);
    }
}

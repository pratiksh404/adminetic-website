<?php

namespace Adminetic\Website\Http\Controllers\API\Client;

use Adminetic\Website\Models\Admin\Video;
use Adminetic\Website\Http\Resources\Video\VideoCollection;
use Adminetic\Website\Http\Resources\Video\VideoResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoClientAPIController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new VideoCollection(Video::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return new VideoResource($video);
    }
}

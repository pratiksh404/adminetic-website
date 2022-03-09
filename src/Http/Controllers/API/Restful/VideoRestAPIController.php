<?php

namespace Adminetic\Website\Http\Controllers\API\Restful;

use Adminetic\Website\Models\Admin\Video;
use Adminetic\Website\Http\Requests\VideoRequest;
use App\Http\Controllers\Controller;
use Adminetic\Website\Contracts\VideoRepositoryInterface;

class VideoRestAPIController extends Controller
{

    protected $videoRepositoryInterface;

    public function __construct(VideoRepositoryInterface $videoRepositoryInterface)
    {
        $this->videoRepositoryInterface = $videoRepositoryInterface;
        $this->authorizeResource(Video::class, 'video');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->videoRepositoryInterface->indexVideo(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\VideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        $video = $this->videoRepositoryInterface->storeVideo($request);
        return response()->json($video, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return response()->json($video, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\VideoRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, Video $video)
    {
        $this->videoRepositoryInterface->updateVideo($request, $video);
        return response()->json($video, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $deleted_item = $video;
        $video->delete();
        return response()->json($deleted_item, 200);
    }
}

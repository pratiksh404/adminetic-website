<?php

namespace Adminetic\Website\Http\Controllers;

use Adminetic\Website\Contracts\VideoRepositoryInterface;
use Adminetic\Website\Http\Requests\VideoRequest;
use Adminetic\Website\Models\Admin\Video;
use App\Http\Controllers\Controller;

class VideoController extends Controller
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
        return view('website::admin.video.index', $this->videoRepositoryInterface->indexVideo());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.video.create', $this->videoRepositoryInterface->createVideo());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\VideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        $this->videoRepositoryInterface->storeVideo($request);

        return redirect(adminRedirectRoute('video'))->withSuccess('Video Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('website::admin.video.show', $this->videoRepositoryInterface->showVideo($video));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('website::admin.video.edit', $this->videoRepositoryInterface->editVideo($video));
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

        return redirect(adminRedirectRoute('video'))->withInfo('Video Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $this->videoRepositoryInterface->destroyVideo($video);

        return redirect(adminRedirectRoute('video'))->withFail('Video Deleted Successfully.');
    }
}

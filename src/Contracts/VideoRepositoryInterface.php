<?php

namespace App\Contracts;

use Adminetic\Website\Models\Admin\Video;
use Adminetic\Website\Http\Requests\VideoRequest;

interface VideoRepositoryInterface
{
    public function indexVideo();

    public function createVideo();

    public function storeVideo(VideoRequest $request);

    public function showVideo(Video $Video);

    public function editVideo(Video $Video);

    public function updateVideo(VideoRequest $request, Video $Video);

    public function destroyVideo(Video $Video);
}

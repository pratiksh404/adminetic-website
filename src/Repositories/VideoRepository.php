<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\VideoRepositoryInterface;
use Adminetic\Website\Http\Requests\VideoRequest;
use Adminetic\Website\Models\Admin\Gallery;
use Adminetic\Website\Models\Admin\Video;
use Illuminate\Support\Facades\Cache;

class VideoRepository implements VideoRepositoryInterface
{
    // Video Index
    public function indexVideo()
    {
        $videos = config('adminetic.caching', true)
            ? (Cache::has('videos') ? Cache::get('videos') : Cache::rememberForever('videos', function () {
                return Video::latest()->get();
            }))
            : Video::latest()->get();

        return compact('videos');
    }

    // Video Create
    public function createVideo()
    {
        $galleries = Cache::get('galleries', Gallery::latest()->get());

        return compact('galleries');
    }

    // Video Store
    public function storeVideo(VideoRequest $request)
    {
        $video = Video::create($request->validated());
        $this->uploadImage($video);
    }

    // Video Show
    public function showVideo(Video $video)
    {
        $galleries = Cache::get('galleries', Gallery::latest()->get());

        return compact('video', 'galleries');
    }

    // Video Edit
    public function editVideo(Video $video)
    {
        return compact('video');
    }

    // Video Update
    public function updateVideo(VideoRequest $request, Video $video)
    {
        $video->update($request->validated());
        $this->uploadImage($video);
    }

    // Video Destroy
    public function destroyVideo(Video $video)
    {
        $video->delete();
    }

    // Upload Image
    protected function uploadImage(Video $video)
    {
        if (request()->thumbnail) {
            $thumbnails = [
                'storage' => 'website/video',
                'width' => '512',
                'height' => '512',
                'quality' => '80',
                'thumbnails' => [
                    [
                        'thumbnail-name' => 'small',
                        'thumbnail-width' => '150',
                        'thumbnail-height' => '100',
                        'thumbnail-quality' => '50',
                    ],
                ],
            ];
            $video->makeThumbnail('thumbnail', $thumbnails);
        }
    }
}

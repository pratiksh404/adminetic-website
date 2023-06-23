<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\DownloadRequest;
use Adminetic\Website\Models\Admin\Download;

interface DownloadRepositoryInterface
{
    public function indexDownload();

    public function createDownload();

    public function storeDownload(DownloadRequest $request);

    public function showDownload(Download $Download);

    public function editDownload(Download $Download);

    public function updateDownload(DownloadRequest $request, Download $Download);

    public function destroyDownload(Download $Download);
}

<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\NoticeRequest;
use Adminetic\Website\Models\Admin\Notice;

interface NoticeRepositoryInterface
{
    public function indexNotice();

    public function createNotice();

    public function storeNotice(NoticeRequest $request);

    public function showNotice(Notice $Notice);

    public function editNotice(Notice $Notice);

    public function updateNotice(NoticeRequest $request, Notice $Notice);

    public function destroyNotice(Notice $Notice);
}

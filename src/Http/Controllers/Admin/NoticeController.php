<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Models\Admin\Notice;
use Illuminate\Http\Request;
use Adminetic\Website\Http\Requests\NoticeRequest;
use App\Http\Controllers\Controller;
use Adminetic\Website\Contracts\NoticeRepositoryInterface;

class NoticeController extends Controller
{
    protected $noticeRepositoryInterface;

    public function __construct(NoticeRepositoryInterface $noticeRepositoryInterface)
    {
        $this->noticeRepositoryInterface = $noticeRepositoryInterface;
        $this->authorizeResource(Notice::class, 'notice');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.notice.index', $this->noticeRepositoryInterface->indexNotice());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.notice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\NoticeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticeRequest $request)
    {
        $this->noticeRepositoryInterface->storeNotice($request);
        return redirect(adminRedirectRoute('notice'))->withSuccess('Notice Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        return view('website::admin.notice.show', $this->noticeRepositoryInterface->showNotice($notice));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        return view('website::admin.notice.edit', $this->noticeRepositoryInterface->editNotice($notice));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\NoticeRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(NoticeRequest $request, Notice $notice)
    {
        $this->noticeRepositoryInterface->updateNotice($request, $notice);
        return redirect(adminRedirectRoute('notice'))->withInfo('Notice Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        $this->noticeRepositoryInterface->destroyNotice($notice);
        return redirect(adminRedirectRoute('notice'))->withFail('Notice Deleted Successfully.');
    }
}

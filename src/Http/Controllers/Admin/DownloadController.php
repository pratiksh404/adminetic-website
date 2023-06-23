<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Models\Admin\Download;
use Illuminate\Http\Request;
use Adminetic\Website\Http\Requests\DownloadRequest;
use App\Http\Controllers\Controller;
use Adminetic\Website\Contracts\DownloadRepositoryInterface;

class DownloadController extends Controller
{
    protected $downloadRepositoryInterface;

    public function __construct(DownloadRepositoryInterface $downloadRepositoryInterface)
    {
        $this->downloadRepositoryInterface = $downloadRepositoryInterface;
        $this->authorizeResource(Download::class, 'download');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.download.index', $this->downloadRepositoryInterface->indexDownload());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.download.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\DownloadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DownloadRequest $request)
    {
        $this->downloadRepositoryInterface->storeDownload($request);
        return redirect(adminRedirectRoute('download'))->withSuccess('Download Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function show(Download $download)
    {
        return view('website::admin.download.show', $this->downloadRepositoryInterface->showDownload($download));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function edit(Download $download)
    {
        return view('website::admin.download.edit', $this->downloadRepositoryInterface->editDownload($download));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\DownloadRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function update(DownloadRequest $request, Download $download)
    {
        $this->downloadRepositoryInterface->updateDownload($request, $download);
        return redirect(adminRedirectRoute('download'))->withInfo('Download Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function destroy(Download $download)
    {
        $this->downloadRepositoryInterface->destroyDownload($download);
        return redirect(adminRedirectRoute('download'))->withFail('Download Deleted Successfully.');
    }
}

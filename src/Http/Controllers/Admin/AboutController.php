<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Contracts\AboutRepositoryInterface;
use Adminetic\Website\Http\Requests\AboutRequest;
use Adminetic\Website\Models\Admin\About;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    protected $aboutRepositoryInterface;

    public function __construct(AboutRepositoryInterface $aboutRepositoryInterface)
    {
        $this->aboutRepositoryInterface = $aboutRepositoryInterface;
        $this->authorizeResource(About::class, 'about');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.about.index', $this->aboutRepositoryInterface->indexAbout());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AboutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AboutRequest $request)
    {
        $this->aboutRepositoryInterface->storeAbout($request);

        return redirect(adminRedirectRoute('about'))->withSuccess('About Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        return view('website::admin.about.show', $this->aboutRepositoryInterface->showAbout($about));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('website::admin.about.edit', $this->aboutRepositoryInterface->editAbout($about));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AboutRequest  $request
     * @param  \App\Models\Admin\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(AboutRequest $request, About $about)
    {
        $this->aboutRepositoryInterface->updateAbout($request, $about);

        return redirect(adminRedirectRoute('about'))->withInfo('About Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        $this->aboutRepositoryInterface->destroyAbout($about);

        return redirect(adminRedirectRoute('about'))->withFail('About Deleted Successfully.');
    }
}

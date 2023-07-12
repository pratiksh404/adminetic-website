<?php

namespace Adminetic\Website\Http\Controllers\Admin;


use Adminetic\Website\Contracts\SliderRepositoryInterface;
use Adminetic\Website\Http\Requests\SliderRequest;
use Adminetic\Website\Models\Admin\Slider;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    protected $sliderRepositoryInterface;

    public function __construct(SliderRepositoryInterface $sliderRepositoryInterface)
    {
        $this->sliderRepositoryInterface = $sliderRepositoryInterface;
        $this->authorizeResource(Slider::class, 'slider');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.slider.index', $this->sliderRepositoryInterface->indexSlider());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Adminetic\Website\Http\Requests\SliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $this->sliderRepositoryInterface->storeSlider($request);
        return redirect(adminRedirectRoute('slider'))->withSuccess('Slider Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return view('website::admin.slider.show', $this->sliderRepositoryInterface->showSlider($slider));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Adminetic\Website\Models\Admin\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('website::admin.slider.edit', $this->sliderRepositoryInterface->editSlider($slider));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Adminetic\Website\Http\Requests\SliderRequest  $request
     * @param  Adminetic\Website\Models\Admin\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        $this->sliderRepositoryInterface->updateSlider($request, $slider);
        return redirect(adminRedirectRoute('slider'))->withInfo('Slider Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Adminetic\Website\Models\Admin\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $this->sliderRepositoryInterface->destroySlider($slider);
        return redirect(adminRedirectRoute('slider'))->withFail('Slider Deleted Successfully.');
    }
}

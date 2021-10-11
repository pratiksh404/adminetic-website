<?php

namespace Adminetic\Website\Http\Controllers;

use Adminetic\Website\Contracts\BlockRepositoryInterface;
use Adminetic\Website\Http\Requests\BlockRequest;
use Adminetic\Website\Models\Admin\Block;
use App\Http\Controllers\Controller;

class BlockController extends Controller
{
    protected $blockRepositoryInterface;

    public function __construct(BlockRepositoryInterface $blockRepositoryInterface)
    {
        $this->blockRepositoryInterface = $blockRepositoryInterface;
        $this->authorizeResource(Block::class, 'block');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.block.index', $this->blockRepositoryInterface->indexBlock());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.block.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\BlockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlockRequest $request)
    {
        $this->blockRepositoryInterface->storeBlock($request);

        return redirect(adminRedirectRoute('block'))->withSuccess('Block Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
        return view('website::admin.block.show', $this->blockRepositoryInterface->showBlock($block));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        return view('website::admin.block.edit', $this->blockRepositoryInterface->editBlock($block));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\BlockRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(BlockRequest $request, Block $block)
    {
        $this->blockRepositoryInterface->updateBlock($request, $block);

        return redirect(adminRedirectRoute('block'))->withInfo('Block Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $block)
    {
        $this->blockRepositoryInterface->destroyBlock($block);

        return redirect(adminRedirectRoute('block'))->withFail('Block Deleted Successfully.');
    }
}

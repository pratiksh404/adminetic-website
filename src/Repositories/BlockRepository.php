<?php

namespace Adminetic\Website\Repositories;

use Adminetic\Website\Contracts\BlockRepositoryInterface;
use Adminetic\Website\Http\Requests\BlockRequest;
use Adminetic\Website\Models\Admin\Block;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class BlockRepository implements BlockRepositoryInterface
{
    // Block Index
    public function indexBlock()
    {
        $blocks = config('adminetic.caching', true)
            ? (Cache::has('blocks') ? Cache::get('blocks') : Cache::rememberForever('blocks', function () {
                return Block::orderBy('position')->get();
            }))
            : Block::orderBy('position')->get();

        return compact('blocks');
    }

    // Block Create
    public function createBlock()
    {
        $block_domains = Block::latest()->pluck('page')->toArray();
        $versions = Block::latest()->pluck('version')->toArray();
        $block_types = Block::latest()->pluck('type')->toArray();

        return compact('block_domains', 'versions', 'block_types');
    }

    // Block Store
    public function storeBlock(BlockRequest $request)
    {
        $block = Block::create($request->validated());
        $this->versionActivationControl($block);
        $this->uploadImage($block);
    }

    // Block Show
    public function showBlock(Block $block)
    {
        return compact('block');
    }

    // Block Edit
    public function editBlock(Block $block)
    {
        $block_domains = Block::latest()->pluck('page')->toArray();
        $versions = Block::latest()->pluck('version')->toArray();
        $block_types = Block::latest()->pluck('type')->toArray();

        return compact('block', 'block_domains', 'versions', 'block_types');
    }

    // Block Update
    public function updateBlock(BlockRequest $request, Block $block)
    {
        $block->update($request->validated());
        $this->versionActivationControl($block);
        $this->uploadImage($block);
    }

    // Block Destroy
    public function destroyBlock(Block $block)
    {
        isset($block->image) ? deleteImage($block->image) : '';
        $block->delete();
    }

    // Image Upload
    protected function uploadImage(Block $block)
    {
        if (request()->has('image')) {
            $block->update([
                'image' => request()->image->store('website/block', 'public'),
            ]);
            $image = Image::make(request()->file('image')->getRealPath());
            $image->save(public_path('storage/' . $block->image));
        }
    }

    // Version Activation Control
    protected function versionActivationControl(Block $block)
    {
        $blocks = Block::where([
            ['id', '<>', $block->id],
            ['type', '=', $block->type],
            ['theme', '=', $block->theme],
        ])->pluck('id')->toArray();

        if ($block->active) {
            Block::whereIn('id', $blocks)->update(['active' => 0]);
        }
    }
}

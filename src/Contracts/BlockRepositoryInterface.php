<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\BlockRequest;
use Adminetic\Website\Models\Admin\Block;

interface BlockRepositoryInterface
{
    public function indexBlock();

    public function createBlock();

    public function storeBlock(BlockRequest $request);

    public function showBlock(Block $Block);

    public function editBlock(Block $Block);

    public function updateBlock(BlockRequest $request, Block $Block);

    public function destroyBlock(Block $Block);
}

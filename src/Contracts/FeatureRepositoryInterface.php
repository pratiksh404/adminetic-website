<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Models\Admin\Feature;
use Adminetic\Website\Http\Requests\FeatureRequest;

interface FeatureRepositoryInterface
{
    public function indexFeature();

    public function createFeature();

    public function storeFeature(FeatureRequest $request);

    public function showFeature(Feature $Feature);

    public function editFeature(Feature $Feature);

    public function updateFeature(FeatureRequest $request, Feature $Feature);

    public function destroyFeature(Feature $Feature);
}

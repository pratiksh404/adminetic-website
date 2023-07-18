<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\AboutRequest;
use Adminetic\Website\Models\Admin\About;

interface AboutRepositoryInterface
{
    public function indexAbout();

    public function createAbout();

    public function storeAbout(AboutRequest $request);

    public function showAbout(About $About);

    public function editAbout(About $About);

    public function updateAbout(AboutRequest $request, About $About);

    public function destroyAbout(About $About);
}

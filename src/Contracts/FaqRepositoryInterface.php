<?php

namespace App\Contracts;

use Adminetic\Website\Models\Admin\Faq;
use Adminetic\Website\Http\Requests\FaqRequest;

interface FaqRepositoryInterface
{
    public function indexFaq();

    public function createFaq();

    public function storeFaq(FaqRequest $request);

    public function showFaq(Faq $Faq);

    public function editFaq(Faq $Faq);

    public function updateFaq(FaqRequest $request, Faq $Faq);

    public function destroyFaq(Faq $Faq);
}

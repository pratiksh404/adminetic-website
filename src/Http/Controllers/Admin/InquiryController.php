<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Models\Admin\Inquiry;
use App\Http\Controllers\Controller;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::latest()->get();

        return view('website::admin.inquiry.index', compact('inquiries'));
    }
}

<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::latest()->get();
        return view('website::admin.inquiry.index', compact('inquiries'));
    }
}

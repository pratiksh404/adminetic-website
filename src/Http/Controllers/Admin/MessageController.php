<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Adminetic\Website\Models\Admin\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        return view('website::admin.message.index', compact('messages'));
    }
}

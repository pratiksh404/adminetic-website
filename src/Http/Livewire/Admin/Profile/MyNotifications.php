<?php

namespace Adminetic\Website\Http\Livewire\Admin\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyNotifications extends Component
{
    public function render()
    {
        $unread_notifications = Auth::user()->unreadNotifications;

        return view('website::livewire.admin.profile.my-notifications', compact('unread_notifications'));
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class Notification extends Component
{
    /**
     * Create a new component instance.
     */
    public $notification ;
    public $newCount ;
    public function __construct($count)
    {
        $user = Auth::user();
        $this->notification = $user->notifications()->take($count)->get();
        $this->newCount = $user->unreadNotifications()->count();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notification');
    }
}

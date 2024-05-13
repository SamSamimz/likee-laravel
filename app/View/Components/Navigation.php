<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navigation extends Component
{
    /**
     * Create a new component instance.
     */
    
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $profilePic = '/storage/profiles/DefaultProfile.png';
        if(auth()->user() && auth()->user()->image) {
            $profilePic = '\storage/'.auth()->user()->image->path;
        }
        return view('components.navigation',compact('profilePic'));
    }
}

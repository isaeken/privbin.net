<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $nav_links = collect([
            [route('home'), __("New"), request()->routeIs('home')],
            [route('notes.index'), __("Notes"), request()->routeIs('notes.index')],
            [route('home'), __("Workspaces"), false],
        ]);
        return view('layouts.app', compact("nav_links"));
    }
}

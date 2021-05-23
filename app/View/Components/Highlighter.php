<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Highlighter extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $content = "",
        public string $language = "text/plain",
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $content = $this->content;
        $language = $this->language;
        return view('components.highlighter', compact('content', 'language'));
    }
}

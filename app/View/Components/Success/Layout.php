<?php

namespace App\View\Components\Success;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $type = 'success',
        public string $code = '200',
        public string $title,
        // public string $imgUrl,
        public string $heading,
        public string $content,
        // public string $btnIcon,
        public string $btnUrl,
        public string $btnText,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.success.layout');
    }
}

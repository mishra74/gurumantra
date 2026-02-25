<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Jorenvh\Share\ShareFacade as Share;

class ShareButtons extends Component
{
    public $post;
    public $share;

    /**
     * Create a new component instance.
     */
    public function __construct($post)
    {
        $this->post = $post;
        $this->share = Share::page(url()->current(), $post->title);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.share-buttons');
    }
}

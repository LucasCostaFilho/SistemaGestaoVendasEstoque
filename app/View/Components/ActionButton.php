<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionButton extends Component
{
    public string $type;
    public string $href;
    public string $color;

    public function __construct(string $type = 'link', string $href = '#', string $color = 'gray')
    {
        $this->type = $type;
        $this->href = $href;
        $this->color = $color;
    }

    public function render(): \Illuminate\View\View
    {
        return view('components.action-button');
    }
}

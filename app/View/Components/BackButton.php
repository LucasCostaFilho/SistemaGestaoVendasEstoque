<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BackButton extends Component
{
    /**
     * A URL de destino para o botão.
     * @var string
     */
    public string $href;

    /**
     * Create a new component instance.
     *
     * @param string $href A URL para a qual o botão deve apontar.
     */
    public function __construct(string $href = '')
    {
        // Se nenhuma URL for fornecida, usa a URL anterior como um fallback inteligente.
        // Se uma URL for fornecida, usa ela.
        $this->href = $href ?: url()->previous();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): \Illuminate\View\View
    {
        return view('components.back-button');
    }
}

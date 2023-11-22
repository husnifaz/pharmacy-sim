<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $idModal;

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($idModal)
    {
        $this->idModal = $idModal;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}

<?php

namespace App\View\Components\actividad;

use Illuminate\View\Component;

class modalActividad extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $proyecto;
    public function __construct($proyecto)
    {
        $this->proyecto;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.actividad.modal-actividad');
    }
}

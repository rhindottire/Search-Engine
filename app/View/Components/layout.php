<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Layout extends Component
{
    public $class;
    public $title;

    public function __construct($class = '', $title = 'Document')
    {
        $this->class = $class;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.layout');
    }
}
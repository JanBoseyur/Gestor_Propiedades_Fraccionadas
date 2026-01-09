<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatCard extends Component
{
    public string $title;
    public string|int $value;
    public string $color;

    public function __construct($title, $value, $color)
    {
        $this->title = $title;
        $this->value = $value;
        $this->color = $color;
    }

    public function render()
    {
        return view('components.StatCard');
    }
}

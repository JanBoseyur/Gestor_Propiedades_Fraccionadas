<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PropertyCard extends Component
{
    public string $title;
    public string $background;
    public string|int $location;
    public string $partners;

    public function __construct($title, $background, $location, $partners)
    {
        $this->title = $title;
        $this->background = $background;
        $this->location = $location;
        $this->partners = $partners;
    }

    public function render()
    {
        return view('components.PropertyCard');
    }
}
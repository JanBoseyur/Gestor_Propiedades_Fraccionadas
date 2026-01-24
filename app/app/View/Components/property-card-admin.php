<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class PropertyCardAdmin extends Component
{
    public string $title;
    public string $background;
    public string $location;
    public int $partners;
    public Collection $socios;

    public function __construct(
        $title,
        $background,
        $location,
        $partners,
        $socios = null   // 👈 OPCIONAL
    ) {
        $this->title = $title;
        $this->background = $background;
        $this->location = $location;
        $this->partners = $partners;
        $this->socios = $socios ?? collect(); // 👈 NUNCA será undefined
    }

    public function render()
    {
        return view('components.property-card-admin');
    }
}

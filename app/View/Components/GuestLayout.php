<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // Esto le dice a Laravel: "Cuando usen <x-guest-layout>,
        // carga el archivo que está en resources/views/layouts/guest.blade.php"
        return view('layouts.guests');
    }
}
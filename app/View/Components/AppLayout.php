<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // Esto le dice a Laravel: "Cuando usen <x-app-layout>,
        // busca el archivo en resources/views/layouts/app.blade.php"
        return view('layouts.app');
    }
}
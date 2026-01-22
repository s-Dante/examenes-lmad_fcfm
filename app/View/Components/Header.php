<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Variante del header: 'auth', 'login', 'public'.
     * @var string
     */
    public string $variant;

    /**
     * Lista de logos a mostrar (rutas de imagen).
     * @var array<string>
     */
    public array $logos;

    public function __construct()
    {
        $this->variant = $this->determineVariant();
        $this->logos = $this->determineLogos();
    }

    /**
     * Determina la variante basada en la ruta y autenticación.
     */
    private function determineVariant(): string
    {
        if (Auth::check()) {
            return 'auth';
        }

        if (Route::currentRouteName() === 'login') {
            return 'login';
        }

        return 'public';
    }

    /**
     * Define qué logos mostrar según la variante.
     */
    private function determineLogos(): array
    {
        $baseLogos = [
            'uanl' => 'img/logo-uanl.png',
            'fcfm' => 'img/logo-fcfm.png',
        ];

        // En vista pública general agregamos LMAD (u otros futuros)
        if ($this->variant === 'public') {
            $baseLogos['lmad'] = 'img/logo-lmad.png'; 
        }

        return $baseLogos;
    }

    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
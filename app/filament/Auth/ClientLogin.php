<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login;
use Illuminate\Contracts\Support\Htmlable;

class ClientLogin extends Login
{
    public function getHeading(): string|Htmlable
    {
        return __('Clientes Login');
    }
}

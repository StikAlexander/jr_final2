<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login;
use Illuminate\Contracts\Support\Htmlable;

class CollaboratorLogin extends Login
{
    public function getHeading(): string|Htmlable
    {
        return __('Colaboradores Login');
    }
}

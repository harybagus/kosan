<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    protected static string $layout = 'filament.pages.auth.layouts.login-layout';
    protected static string $view   = 'filament.pages.auth.login';
}

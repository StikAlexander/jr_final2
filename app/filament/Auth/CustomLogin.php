<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;

class CustomLogin extends Login
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getUserTypeComponent(),
                        $this->getDocumentTypeComponent(),
                        $this->getLoginFormComponent(),
                        $this->getPasswordFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getUserTypeComponent(): \Filament\Forms\Components\Component
    {
        return Select::make('tipo_usuario')
            ->label(__('Tipo de usuario'))
            ->options([
                'cliente' => 'Cliente',
                'colaborador' => 'Colaborador',
                'administrador' => 'Administrador',
            ])
            ->required()
            ->reactive()
            ->default('cliente')
            ->afterStateUpdated(fn (callable $set) => $set('login', ''));
    }

    protected function getDocumentTypeComponent(): \Filament\Forms\Components\Component
    {
        return Select::make('tipo_documento')
            ->label(__('Tipo de documento'))
            ->options([
                'CC' => 'CC',
                'TI' => 'TI',
                'RC' => 'RC',
                'CE' => 'CE',
                'PEP' => 'PEP',
                'NIT' => 'NIT',
            ])
            ->required(fn (callable $get) => $get('tipo_usuario') !== 'administrador')
            ->hidden(fn (callable $get) => $get('tipo_usuario') === 'administrador');
    }

    protected function getLoginFormComponent(): \Filament\Forms\Components\Component
    {
        return TextInput::make('login')
            ->label(fn (callable $get) => $get('tipo_usuario') === 'administrador' ? __('Correo electrónico') : __('Número de documento'))
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1])
            ->hidden(fn (callable $get) => $get('tipo_usuario') === 'administrador' && $get('tipo_documento') !== null);
    }

    protected function getPasswordFormComponent(): \Filament\Forms\Components\Component
    {
        return TextInput::make('password')
            ->label(__('Contraseña'))
            ->password()
            ->required(fn (callable $get) => $get('tipo_usuario') !== 'cliente')
            ->extraInputAttributes(['tabindex' => 2])
            ->hidden(fn (callable $get) => $get('tipo_usuario') === 'cliente');
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        $tipo_usuario = $data['tipo_usuario'];
        $login = $data['login'];
        $password = $data['password'] ?? null;

        if ($tipo_usuario === 'administrador') {
            return [
                'email' => $login,
                'password' => $password,
            ];
        } elseif ($tipo_usuario === 'colaborador') {
            return [
                'tipo_documento' => $data['tipo_documento'],
                'numero_documento' => $login,
                'password' => $password,
            ];
        } else {
            return [
                'tipo_documento' => $data['tipo_documento'],
                'numero_documento' => $login,
            ];
        }
    }

    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();
        $credentials = $this->getCredentialsFromFormData($data);
        $tipo_usuario = $data['tipo_usuario'];

        if ($tipo_usuario === 'administrador') {
            if (Auth::attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ])) {
                session()->regenerate();
                return app(LoginResponse::class);
            }
        } elseif ($tipo_usuario === 'colaborador') {
            $user = User::where('tipo_documento', $credentials['tipo_documento'])
                ->where('numero_documento', $credentials['numero_documento'])
                ->first();

            if ($user && Hash::check($credentials['password'], $user->password)) {
                Auth::login($user);
                session()->regenerate();
                return app(LoginResponse::class);
            }
        } else {
            $user = User::where('tipo_documento', $credentials['tipo_documento'])
                ->where('numero_documento', $credentials['numero_documento'])
                ->first();

            if ($user) {
                Auth::login($user);
                session()->regenerate();
                return app(LoginResponse::class);
            }
        }

        $this->throwFailureValidationException();
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.login' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}

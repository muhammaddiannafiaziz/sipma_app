<?php

namespace App\Filament\Santri\Pages\Auth;

// PERBAIKAN: Component diambil dari Schemas, bukan Forms
use Filament\Schemas\Components\Component; 
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Auth\Pages\Login as BaseLogin;

class Login extends BaseLogin
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getIdentityNumberFormComponent(), 
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ]);
    }

    protected function getIdentityNumberFormComponent(): Component
    {
        return TextInput::make('identity_number')
            ->label('NIM')
            ->required()
            ->numeric()
            ->length(9)
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'identity_number' => $data['identity_number'],
            'password' => $data['password'],
        ];
    }
}
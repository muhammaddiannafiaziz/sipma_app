<?php

namespace App\Filament\Resources\Semesters\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SemesterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('academic_year_id')
                    ->relationship('academicYear', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('period_index')
                    ->required()
                    ->numeric(),
                Toggle::make('is_active')
                    ->required(),
                Toggle::make('is_krs_open')
                    ->required(),
            ]);
    }
}

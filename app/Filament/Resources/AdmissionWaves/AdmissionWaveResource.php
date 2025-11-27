<?php

namespace App\Filament\Resources\AdmissionWaves;

use App\Filament\Resources\AdmissionWaves\Pages\CreateAdmissionWave;
use App\Filament\Resources\AdmissionWaves\Pages\EditAdmissionWave;
use App\Filament\Resources\AdmissionWaves\Pages\ListAdmissionWaves;
use App\Filament\Resources\AdmissionWaves\Schemas\AdmissionWaveForm;
use App\Filament\Resources\AdmissionWaves\Tables\AdmissionWavesTable;
use App\Models\AdmissionWave;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;

class AdmissionWaveResource extends Resource
{
    protected static ?string $model = AdmissionWave::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pengaturan Gelombang')
                    ->schema([
                        Select::make('academic_year_id')
                            ->relationship('academicYear', 'name')
                            ->required(),
                        TextInput::make('name')
                            ->label('Nama Gelombang')
                            ->placeholder('Contoh: Gelombang 1 - Diniyah')
                            ->required(),
                        Textarea::make('description')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Durasi & Status')
                    ->schema([
                        DatePicker::make('start_date')->required(),
                        DatePicker::make('end_date')->required(),
                        Toggle::make('is_open')
                            ->label('Buka Pendaftaran')
                            ->helperText('Jika aktif, form pendaftaran publik bisa diakses.')
                            ->onColor('success')
                            ->offColor('danger'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('academicYear.name')->label('Tahun'),
                TextColumn::make('name')->searchable(),
                TextColumn::make('start_date')->date()->label('Mulai'),
                TextColumn::make('end_date')->date()->label('Selesai'),
                
                // Indikator Visual Canggih
                TextColumn::make('is_open')
                    ->badge()
                    ->label('Status')
                    ->formatStateUsing(fn (bool $state) => $state ? 'BUKA' : 'TUTUP')
                    ->color(fn (bool $state) => $state ? 'success' : 'danger'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdmissionWaves::route('/'),
            'create' => CreateAdmissionWave::route('/create'),
            'edit' => EditAdmissionWave::route('/{record}/edit'),
        ];
    }
}

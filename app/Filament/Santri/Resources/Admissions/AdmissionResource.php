<?php

namespace App\Filament\Santri\Resources\Admissions; // NAMESPACE PLURAL (V4 STANDARD)

use App\Filament\Santri\Resources\Admissions\Pages;
use App\Models\Admission;
use BackedEnum;
use Illuminate\Support\Facades\Auth;

// --- PERBAIKAN NAMESPACE DI SINI ---
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;

// 1. Komponen INPUT tetap di 'Forms'
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

// 2. Komponen LAYOUT pindah ke 'Schemas' (Ini penyebab error Anda)
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;

class AdmissionResource extends Resource
{
    protected static ?string $model = Admission::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Misi Pemberkasan';
    protected static ?string $pluralModelLabel = 'Berkas Pendaftaran';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    // LEVEL 1: Akademik
                    Step::make('Level 1: Akademik') // Gunakan Step::make langsung
                        ->description('Riwayat Sekolah')
                        ->icon('heroicon-o-academic-cap')
                        ->schema([
                            Section::make('Asal Sekolah')
                                ->schema([
                                    TextInput::make('sekolah_asal')->label('Nama Sekolah Asal')->placeholder('Contoh: MAN 1 Yogyakarta')->required(),
                                    Radio::make('pernah_mondok')->label('Pernah Mondok?')->boolean()->inline()->reactive(),
                                    TextInput::make('nama_pondok')->label('Nama Pondok')->visible(fn ($get) => $get('pernah_mondok'))->required(fn ($get) => $get('pernah_mondok')),
                                    TextInput::make('lama')->label('Lama Mondok (Tahun)')->numeric()->visible(fn ($get) => $get('pernah_mondok')),
                                    Textarea::make('prestasi')->label('Prestasi (Opsional)'),
                                ]),
                        ]),
                    
                    // LEVEL 2: Upload
                    Step::make('Level 2: Upload')
                        ->description('Dokumen')
                        ->icon('heroicon-o-folder-open')
                        ->schema([
                            Section::make('Berkas Digital')
                                ->schema([
                                    FileUpload::make('pas_foto')->label('Pas Foto Resmi')->image()->avatar()->directory('admissions/photos')->maxSize(2048)->required(),
                                    FileUpload::make('uploaded_files')->label('Ijazah & KK (PDF)')->directory('admissions/documents')->acceptedFileTypes(['application/pdf'])->maxSize(5120)->required(),
                                ]),
                        ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_pendaftaran')->searchable(),
                TextColumn::make('created_at')->date()->label('Tanggal'),
                TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'draft' => 'gray',
                    'submitted' => 'warning',
                    'passed' => 'success',
                    'failed' => 'danger',
                    default => 'info',
                }),
            ])
            ->actions([EditAction::make()->label('Lanjutkan Misi')]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdmissions::route('/'),
            'create' => Pages\CreateAdmission::route('/create'),
            'edit' => Pages\EditAdmission::route('/{record}/edit'),
        ];
    }
}
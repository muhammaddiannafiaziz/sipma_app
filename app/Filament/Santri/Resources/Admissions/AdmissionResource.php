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
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;

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
                    // LEVEL 1: Biodata Diri (Target: student_profiles)
                    Step::make('Level 1: Biodata')
                        ->description('Data Diri Santri')
                        ->icon('heroicon-o-user')
                        ->schema([
                            Section::make('Identitas Utama')
                                ->schema([
                                    TextInput::make('tempat_lahir')->required(),
                                    DatePicker::make('tanggal_lahir')->required(),
                                    Select::make('jenis_kelamin')
                                        ->options([
                                            'L' => 'Laki-laki',
                                            'P' => 'Perempuan'
                                        ])->required(),
                                    TextInput::make('no_hp')
                                        ->label('No. WhatsApp')
                                        ->tel()
                                        ->required(),
                                ])->columns(2),
                        ]),

                    // LEVEL 2: Domisili & Orang Tua (Target: student_profiles)
                    Step::make('Level 2: Domisili & Ortu')
                        ->description('Alamat & Keluarga')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Alamat Lengkap (Sesuai KTP)')
                                ->schema([
                                    TextInput::make('jalan')->label('Jalan / Dusun / RT RW')->columnSpanFull()->required(),
                                    TextInput::make('kelurahan')->required(),
                                    TextInput::make('kecamatan')->required(),
                                    TextInput::make('kabupaten')->label('Kabupaten/Kota')->required(),
                                    TextInput::make('provinsi')->required(),
                                    TextInput::make('kode_pos')->numeric()->required(),
                                ])->columns(2),

                            Section::make('Data Orang Tua / Wali')
                                ->schema([
                                    TextInput::make('nama_ortu')->label('Nama Ayah/Ibu')->required(),
                                    TextInput::make('pekerjaan_ortu')->label('Pekerjaan')->required(),
                                    TextInput::make('nohp_ortu')->label('No. HP Orang Tua')->tel()->required(),
                                ])->columns(2),
                        ]),

                    // LEVEL 3: Akademik (Target: admissions)
                    Step::make('Level 3: Pendidikan')
                        ->description('Riwayat Sekolah')
                        ->icon('heroicon-o-academic-cap')
                        ->schema([
                            Section::make('Asal Sekolah')
                                ->schema([
                                    TextInput::make('sekolah_asal')->label('Nama Sekolah Asal')->placeholder('Contoh: MAN 1 Yogyakarta')->required(),
                                    Radio::make('pernah_mondok')->label('Pernah Mondok?')->boolean()->inline()->reactive(),
                                    TextInput::make('nama_pondok')->label('Nama Pondok')->visible(fn($get) => $get('pernah_mondok'))->required(fn($get) => $get('pernah_mondok')),
                                    TextInput::make('lama')->label('Lama Mondok (Tahun)')->numeric()->visible(fn($get) => $get('pernah_mondok')),
                                    Textarea::make('prestasi')->label('Prestasi (Opsional)'),
                                ]),
                        ]),

                    // LEVEL 4: Upload (Target: admissions)
                    Step::make('Level 4: Upload')
                        ->description('Dokumen')
                        ->icon('heroicon-o-folder-open')
                        ->schema([
                            Section::make('Berkas Digital')
                                ->schema([
                                    FileUpload::make('pas_foto')->image()->avatar()->directory('admissions/photos')->maxSize(2048)->required(),
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
<?php

namespace App\Filament\Pages;

use App\Models\MasterTemplate;
use App\Models\MonitoringDeskel;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class MasterTemplatePage extends Page
{

    protected ?string $heading = 'Kelola Penilaian Monitoring';

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static string $view = 'filament.pages.master-template';
    protected static ?string $navigationLabel = 'Kelola Penilaian Monitoring';
    protected static ?string $navigationGroup = 'Admin';
    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return Auth::user()?->hasAnyRole(['Super Admin', 'Admin']);
    }

    public function getViewData(): array
    {
        $template = MasterTemplate::first();

        return [
            'detailProgress' => $template ? $template->detail_progress : [],
        ];
    }

    public array $detailProgress = [];
    public bool $showModal = false;
    protected $listeners = ['openModalMasterTemplateForm' => 'openModal'];

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function mount()
    {
        $template = MasterTemplate::first();
        $this->detailProgress = $template?->detail_progress ?? [];
    }

    public function addIndikator()
    {
        $this->detailProgress[] = [
            'indikator' => '',
            'detail' => [],
        ];
    }

    public function removeIndikator($index)
    {
        unset($this->detailProgress[$index]);
        $this->detailProgress = array_values($this->detailProgress);

        Notification::make()
            ->title('Indikator Terhapus')
            ->danger()
            ->send();
    }

    public function addDetail($indikatorIndex)
    {
        $this->detailProgress[$indikatorIndex]['detail'][] = ['nama' => ''];
    }

    public function removeDetail($indikatorIndex, $detailIndex)
    {
        unset($this->detailProgress[$indikatorIndex]['detail'][$detailIndex]);
        $this->detailProgress[$indikatorIndex]['detail'] = array_values($this->detailProgress[$indikatorIndex]['detail']);

        Notification::make()
            ->title('Detail Indikator Terhapus')
            ->danger()
            ->send();
    }

    public function save()
    {
        // 1. Simpan MasterTemplate terbaru
        MasterTemplate::updateOrCreate(
            ['id' => 1],
            ['detail_progress' => $this->detailProgress]
        );

        // 2. Ambil template yang sudah disimpan
        $template = $this->detailProgress;

        // 3. Ambil semua monitoring yang perlu di-update
        $allMonitoring = MonitoringDeskel::all();

        foreach ($allMonitoring as $monitoring) {
            $oldProgress = $monitoring->detail_progress;

            $updatedProgress = collect($template)->map(function ($indikatorTemplate) use ($oldProgress) {
                $indikatorNama = $indikatorTemplate['indikator'];
                $templateDetail = $indikatorTemplate['detail'];

                // Cari indikator yang sama di data lama
                $oldIndikator = collect($oldProgress)->firstWhere('indikator', $indikatorNama);
                $oldDetail = collect($oldIndikator['detail'] ?? []);

                // Loop semua detail template
                $updatedDetail = collect($templateDetail)->map(function ($detailItem) use ($oldDetail) {
                    $namaDetail = $detailItem['nama'];

                    // Cek apakah detail lama memiliki nama yang sama
                    $old = $oldDetail->firstWhere('nama', $namaDetail);

                    return [
                        'nama' => $namaDetail,
                        'nilai' => $old['nilai'] ?? 0,
                    ];
                });

                return [
                    'indikator' => $indikatorNama,
                    'detail' => $updatedDetail->toArray(),
                    'nilai' => round($updatedDetail->pluck('nilai')->avg(), 2),
                ];
            });

            // Hitung progress keseluruhan
            $overallAvg = round($updatedProgress->pluck('nilai')->avg(), 2);

            $monitoring->update([
                'detail_progress' => $updatedProgress,
                'progress_persen' => $overallAvg,
            ]);
        }

        Notification::make()
            ->title('Template berhasil disimpan & semua desa disinkronkan!')
            ->success()
            ->send();
    }
}

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

    public function addAspek()
    {
        $this->detailProgress[] = [
            'aspek' => '',
            'indikator' => [],
        ];
    }

    public function removeAspek($index)
    {
        unset($this->detailProgress[$index]);
        $this->detailProgress = array_values($this->detailProgress);

        Notification::make()
            ->title('Aspek Terhapus')
            ->danger()
            ->send();
    }

    public function addIndikator($indikatorIndex)
    {
        $this->detailProgress[$indikatorIndex]['indikator'][] = ['nama' => ''];
    }

    public function removeIndikator($indikatorIndex, $detailIndex)
    {
        unset($this->detailProgress[$indikatorIndex]['indikator'][$detailIndex]);
        $this->detailProgress[$indikatorIndex]['indikator'] = array_values($this->detailProgress[$indikatorIndex]['indikator']);

        Notification::make()
            ->title('Indikator Terhapus')
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

        // 2. Ambil template yang baru saja disimpan (dari Livewire property)
        $template = $this->detailProgress;

        // 3. Ambil semua data MonitoringDeskel
        $allMonitoring = MonitoringDeskel::all();

        foreach ($allMonitoring as $monitoring) {
            $oldProgress = $monitoring->detail_progress;

            $updatedProgress = collect($template)->map(function ($aspekTemplate) use ($oldProgress) {
                $aspekNama = $aspekTemplate['aspek'];
                $templateIndikator = $aspekTemplate['indikator'];

                // Cari aspek yang sama di progress lama
                $oldAspek = collect($oldProgress)->firstWhere('aspek', $aspekNama);
                $oldIndikator = collect($oldAspek['indikator'] ?? []);

                // Loop indikator
                $updatedIndikator = collect($templateIndikator)->map(function ($indikatorItem) use ($oldIndikator) {
                    $namaIndikator = $indikatorItem['nama'];

                    // Ambil nilai lama jika ada
                    $old = $oldIndikator->firstWhere('nama', $namaIndikator);

                    return [
                        'nama' => $namaIndikator,
                        'nilai' => $old['nilai'] ?? 0,
                    ];
                });

                return [
                    'aspek' => $aspekNama,
                    'indikator' => $updatedIndikator->toArray(),
                    'nilai' => round($updatedIndikator->pluck('nilai')->avg(), 2),
                ];
            });

            // Hitung rata-rata semua aspek
            $overallAvg = round($updatedProgress->pluck('nilai')->avg(), 2);

            // Update data monitoring
            $monitoring->update([
                'detail_progress' => $updatedProgress,
                'progress_persen' => $overallAvg,
            ]);
        }

        // 4. Notifikasi sukses
        Notification::make()
            ->title('Template berhasil disimpan & semua desa disinkronkan!')
            ->success()
            ->send();
    }
}

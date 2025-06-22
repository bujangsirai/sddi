<?php

namespace App\Filament\Pages;

use App\Models\MasterTemplate;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class MasterTemplatePage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static string $view = 'filament.pages.master-template';
    protected static ?string $navigationLabel = 'Kelola Indikator Monitoring';
    protected static ?string $navigationGroup = 'Admin';
    protected static ?int $navigationSort = 1;

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
        MasterTemplate::updateOrCreate(
            ['id' => 1],
            ['detail_progress' => $this->detailProgress]
        );

        Notification::make()
            ->title('Template berhasil disimpan!')
            ->success()
            ->send();
    }
}

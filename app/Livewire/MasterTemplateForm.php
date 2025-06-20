<?php

namespace App\Livewire;

use App\Models\MasterTemplate;
use Livewire\Component;

class MasterTemplateForm extends Component
{
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
    }

    public function addDetail($indikatorIndex)
    {
        $this->detailProgress[$indikatorIndex]['detail'][] = ['nama' => ''];
    }

    public function removeDetail($indikatorIndex, $detailIndex)
    {
        unset($this->detailProgress[$indikatorIndex]['detail'][$detailIndex]);
        $this->detailProgress[$indikatorIndex]['detail'] = array_values($this->detailProgress[$indikatorIndex]['detail']);
    }

    public function save()
    {
        MasterTemplate::updateOrCreate(
            ['id' => 1],
            ['detail_progress' => $this->detailProgress]
        );
        session()->flash('message', 'Template berhasil disimpan!');
    }

    public function render()
    {
        return view('livewire.master-template-form');
    }
}

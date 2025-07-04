<x-filament-panels::page>

    <div class="space-y-4">

        <x-filament::button color="primary" wire:click="addIndikator">
            <div class="flex items-center gap-x-1">
                <x-heroicon-o-plus class="w-4 h-4" />
                Tambah Aspek
            </div>
        </x-filament::button>


        <x-filament::button color="success" wire:click="save">
            <div class="flex items-center gap-x-1">
                <x-heroicon-o-document-arrow-down class="w-4 h-4" />
                Simpan
            </div>
        </x-filament::button>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

            @foreach ($detailProgress as $i => $indikator)
                <x-filament::card>


                    <label class="items-center justify-between block w-full mb-2 text-sm font-medium text-gray-700">
                        <div class="flex items-baseline justify-between">
                            <span class="text-lg">
                                Aspek
                            </span>
                            <x-filament::button color="danger" size="sm"
                                wire:click="removeIndikator({{ $i }})">
                                <div class="flex items-center gap-x-1">
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                    Hapus Aspek
                                </div>
                            </x-filament::button>
                        </div>

                        <div class="flex w-full gap-2 mt-1">
                            <input wire:model="detailProgress.{{ $i }}.indikator"
                                class="flex-grow p-2 border rounded" placeholder="Nama Indikator">
                        </div>
                    </label>

                    <div class=h-2></div>
                    <label
                        class="items-center justify-between block w-full mb-2 space-y-2 text-sm font-medium text-gray-700">
                        <div class="flex items-baseline justify-between">
                            <span class="text-lg">
                                Indikator
                            </span>
                            <x-filament::button size="sm" wire:click="addDetail({{ $i }})">
                                <div class="flex items-center gap-x-1">
                                    <x-heroicon-o-plus class="w-4 h-4" />
                                    Tambah Indikator
                                </div>
                            </x-filament::button>
                        </div>

                        @foreach ($indikator['detail'] as $j => $item)
                            <div class="flex gap-2">
                                <input wire:model="detailProgress.{{ $i }}.detail.{{ $j }}.nama"
                                    class="w-full p-2 border rounded" placeholder="Nama Detail">
                                <x-filament::button size="sm" color="danger"
                                    wire:click="removeDetail({{ $i }}, {{ $j }})">
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                </x-filament::button>
                            </div>
                        @endforeach
                    </label>

                </x-filament::card>
            @endforeach
        </div>
    </div>



</x-filament-panels::page>

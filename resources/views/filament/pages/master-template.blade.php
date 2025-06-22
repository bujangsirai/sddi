<x-filament-panels::page>

    <x-filament::modal>

        <x-slot name="trigger">
            <x-filament::button>
                Ubah Indikator
            </x-filament::button>
        </x-slot>

        <x-slot name="heading">
            Ubah Daftar Indikator
        </x-slot>

        <div class="space-y-4">

            <x-filament::button color="primary" wire:click="addIndikator"> + Tambah Indikator</x-filament::button>
            <x-filament::button color="success" wire:click="save"> Simpan</x-filament::button>


            @foreach ($detailProgress as $i => $indikator)
                <x-filament::card>
                    <label class="items-center justify-between block w-full mb-2 text-sm font-medium text-gray-700">
                        Nama Indikator
                        <div class="flex w-full gap-2 mt-1">
                            <input wire:model="detailProgress.{{ $i }}.indikator"
                                class="flex-grow p-2 border rounded" placeholder="Nama Indikator">
                            <x-filament::button color="danger" size="sm"
                                wire:click="removeIndikator({{ $i }})" class="p-2">
                                <x-heroicon-o-trash class="w-4 h-4" />
                            </x-filament::button>
                        </div>
                    </label>

                    <label
                        class="items-center justify-between block w-full mb-2 space-y-2 text-sm font-medium text-gray-700">
                        Detail Indikator
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

                    <div class="mt-2">
                        <x-filament::button size="sm" wire:click="addDetail({{ $i }})">
                            + Tambah Detail Indikator
                        </x-filament::button>
                    </div>

                </x-filament::card>
            @endforeach

            @if (session()->has('message'))
                <div class="text-green-600">{{ session('message') }}</div>
            @endif
        </div>

    </x-filament::modal>

    <div class="space-y-6 ">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            @foreach ($detailProgress as $indikator)
                <x-filament::card class="h-full">
                    <h2 class="mb-2 text-lg font-semibold">{{ $indikator['indikator'] }}</h2>
                    <ul class="text-sm text-gray-700 list-disc list-inside">
                        @foreach ($indikator['detail'] as $item)
                            <li>{{ $item['nama'] }}</li>
                        @endforeach
                    </ul>
                </x-filament::card>
            @endforeach
        </div>
    </div>

</x-filament-panels::page>

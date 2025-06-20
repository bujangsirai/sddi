<x-filament-panels::page>

    <div class="space-y-6 border border-red-400">


        <livewire:master-template-form />

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

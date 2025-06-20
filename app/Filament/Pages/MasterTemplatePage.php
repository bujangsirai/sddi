<?php

namespace App\Filament\Pages;

use App\Models\MasterTemplate;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

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
}

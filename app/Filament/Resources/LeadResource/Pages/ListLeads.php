<?php

namespace App\Filament\Resources\LeadResource\Pages;

use App\Filament\Exports\LeadExporter;
use App\Filament\Resources\LeadResource;
use Apriansyahrs\CustomFields\Filament\Tables\Concerns\InteractsWithCustomFields;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeads extends ListRecords
{
    use InteractsWithCustomFields;

    protected static string $resource = LeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ExportAction::make()
                ->exporter(LeadExporter::class)
        ];
    }
}

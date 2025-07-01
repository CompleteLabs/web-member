<?php

namespace App\Filament\Resources\LeadResource\Pages;

use App\Filament\Resources\LeadResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLead extends CreateRecord
{
    protected static string $resource = LeadResource::class;

    public function mount(): void
    {
        parent::mount();

        // Pre-fill phone from URL parameter
        if (request()->has('phone')) {
            $phone = request()->get('phone');
            $this->form->fill(['phone' => $phone]);
        }
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Pre-fill phone from URL parameter if provided (backup)
        if (request()->has('phone') && empty($data['phone'])) {
            $data['phone'] = request()->get('phone');
        }

        return $data;
    }
}

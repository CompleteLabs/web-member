<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Http;

class WhatsAppNumberCheckerWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.widgets.whatsapp-number-checker-widget';

    protected int | string | array $columnSpan = 'full';

    public ?string $numbers = '';

    public array $results = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('numbers')
                    ->label('Nomor WhatsApp')
                    ->placeholder('Masukkan nomor telepon, satu per baris. Contoh:
08123456789
08987654321
+628123456789')
                    ->rows(5)
                    ->helperText('Masukkan nomor telepon yang akan dicek, satu nomor per baris')
                    ->required(),
            ]);
    }

    public function checkNumbers(): void
    {
        $this->validate();

        // Parse numbers from textarea
        $rawNumbers = array_filter(
            array_map('trim', explode("\n", $this->numbers)),
            fn($number) => !empty($number)
        );

        if (empty($rawNumbers)) {
            Notification::make()
                ->title('Error')
                ->body('Silakan masukkan minimal satu nomor telepon')
                ->danger()
                ->send();
            return;
        }

        // Clean and format numbers
        $numbers = collect($rawNumbers)->map(function ($number) {
            // Remove all non-numeric characters except +
            $cleaned = preg_replace('/[^\d+]/', '', $number);

            // Remove leading + if exists
            $cleaned = ltrim($cleaned, '+');

            // Handle Indonesian numbers
            if (str_starts_with($cleaned, '0')) {
                $cleaned = '62' . substr($cleaned, 1);
            } elseif (str_starts_with($cleaned, '62')) {
                // Already in correct format
            } else {
                // Assume it's Indonesian number without leading 0
                $cleaned = '62' . $cleaned;
            }

            return $cleaned;
        })->toArray();

        try {
            $response = Http::timeout(30)->post('https://wa-checker.completeselular.com/api/check-number', [
                'numbers' => $numbers,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $this->results = $data['results'] ?? [];

                Notification::make()
                    ->title('Berhasil')
                    ->body('Pengecekan nomor berhasil dilakukan')
                    ->success()
                    ->send();
            } else {
                Notification::make()
                    ->title('Error')
                    ->body('Gagal melakukan pengecekan: ' . $response->status())
                    ->danger()
                    ->send();
            }
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error')
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function clearResults(): void
    {
        $this->results = [];
        $this->numbers = '';
    }
}

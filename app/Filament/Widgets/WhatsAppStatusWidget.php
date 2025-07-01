<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Http;

class WhatsAppStatusWidget extends Widget
{
    protected static string $view = 'filament.widgets.whatsapp-status-widget';

    protected int | string | array $columnSpan = 'full';

    public function getViewData(): array
    {
        try {
            $response = Http::timeout(10)->get('https://wa-checker.completeselular.com/api/status');

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'connected' => $data['connected'] ?? false,
                    'qrCode' => $data['qrCode'] ?? null,
                    'message' => $data['message'] ?? 'Unknown status',
                    'error' => null,
                ];
            } else {
                return [
                    'connected' => false,
                    'qrCode' => null,
                    'message' => 'Failed to fetch status',
                    'error' => 'API Error: ' . $response->status(),
                ];
            }
        } catch (\Exception $e) {
            return [
                'connected' => false,
                'qrCode' => null,
                'message' => 'Connection error',
                'error' => $e->getMessage(),
            ];
        }
    }
}

<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            WhatsApp Status
        </x-slot>

        <div class="space-y-4">
            @if($error)
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400 dark:text-red-300" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Connection Error</h3>
                            <p class="text-sm text-red-700 dark:text-red-300 mt-1">{{ $error }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            @if($connected)
                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                            @else
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold {{ $connected ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $connected ? 'Connected' : 'Disconnected' }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $message }}</p>
                        </div>
                    </div>

                    <button
                        type="button"
                        onclick="location.reload()"
                        class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Refresh
                    </button>
                </div>

                @if(!$connected && $qrCode)
                    <div class="mt-4 text-center">
                        <h4 class="text-md font-medium text-gray-900 dark:text-gray-100 mb-3">Scan QR Code untuk Connect</h4>
                        <div class="inline-block p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow">
                            <img src="{{ $qrCode }}" alt="WhatsApp QR Code" class="w-48 h-48 mx-auto">
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Scan QR code ini dengan WhatsApp di ponsel Anda</p>
                    </div>
                @endif
            @endif
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

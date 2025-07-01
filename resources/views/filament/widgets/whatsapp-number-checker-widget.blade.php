<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.051 3.786"/>
                </svg>
                <span class="text-gray-900 dark:text-gray-100">WhatsApp Number Checker</span>
            </div>
        </x-slot>

        <div class="space-y-8">
            <!-- Input Form Section -->
            <div class="bg-gray-50/50 dark:bg-gray-800/50 rounded-xl p-6 border border-gray-100 dark:border-gray-700">
                <form wire:submit="checkNumbers" class="space-y-4">
                    {{ $this->form }}

                    <div class="flex flex-col sm:flex-row gap-3 pt-2">
                        <x-filament::button
                            type="submit"
                            size="md"
                            wire:loading.attr="disabled"
                            class="flex-1 sm:flex-none"
                            icon="heroicon-m-magnifying-glass"
                        >
                            <span wire:loading.remove>Check Numbers</span>
                            <span wire:loading class="flex items-center gap-2">
                                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Checking...
                            </span>
                        </x-filament::button>

                        @if(!empty($results))
                            <x-filament::button
                                color="gray"
                                size="md"
                                wire:click="clearResults"
                                icon="heroicon-m-trash"
                                outlined
                            >
                                Clear Results
                            </x-filament::button>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Results Section -->
            @if(!empty($results))
                <div class="space-y-6 mt-6">
                    <!-- Results Table -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                Hasil Pengecekan
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300">
                                    {{ count($results) }} nomor
                                </span>
                            </h3>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col" class="w-2/5 px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Nomor Telepon
                                        </th>
                                        <th scope="col" class="w-1/5 px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Status WhatsApp
                                        </th>
                                        <th scope="col" class="w-2/5 px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                                    @foreach($results as $result)
                                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                            <td class="w-2/5 px-4 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center flex-shrink-0">
                                                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                                        </svg>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ $result['original'] }}</p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $result['formatted'] }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-1/5 px-4 py-4 text-center">
                                                @if($result['exists'])
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 border border-green-200 dark:border-green-700">
                                                        <div class="w-1.5 h-1.5 bg-green-500 dark:bg-green-400 rounded-full flex-shrink-0"></div>
                                                        Terdaftar
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-700">
                                                        <div class="w-1.5 h-1.5 bg-red-500 dark:bg-red-400 rounded-full flex-shrink-0"></div>
                                                        Tidak Terdaftar
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="w-2/5 px-4 py-4 text-center">
                                                @if($result['exists'])
                                                    <x-filament::button
                                                        tag="a"
                                                        href="{{ url('/admin/leads/create?phone=' . urlencode($result['original'])) }}"
                                                        target="_blank"
                                                        size="sm"
                                                        color="success"
                                                        icon="heroicon-m-plus"
                                                        tooltip="Create new lead with this phone number"
                                                        class="w-full sm:w-auto"
                                                    >
                                                        Create Lead
                                                    </x-filament::button>
                                                @else
                                                    <span class="text-xs text-gray-400 dark:text-gray-500">—</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

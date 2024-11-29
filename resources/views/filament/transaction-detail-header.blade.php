<div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold text-gray-900">
        {{ $title }}
    </h1>
    <div class="flex items-center space-x-2">
        <x-filament::button
            color="secondary"
            icon="heroicon-o-arrow-left"
            :url="route('filament.dashboard.resources.transaction-products.index')">
            Kembali
        </x-filament::button>
    </div>
</div>

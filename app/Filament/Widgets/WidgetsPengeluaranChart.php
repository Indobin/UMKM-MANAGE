<?php

namespace App\Filament\Widgets;
use Flowframe\Trend\Trend;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;


class WidgetsPengeluaranChart extends ChartWidget
{
    use InteractsWithPageFilters;
    protected static ?string $heading = 'Pengeluaran';
    protected static string $color = 'danger';
    protected function getData(): array
    {
        $startDate = !empty($this->filters['startDate'])
        ? Carbon::parse($this->filters['startDate'])
        : now()->startOfYear(); // Default ke awal tahun ini jika null

    $endDate = !empty($this->filters['endDate'])
        ? Carbon::parse($this->filters['endDate'])
        : now(); // Default ke tanggal saat ini jika null

    $filteredQuery = Transaction::where('pemasukan', false);

    $data = Trend::query($filteredQuery)
        ->between(
            start: $startDate,
            end: $endDate,
        )
        ->perMonth()
        ->sum('jumlah');
//         Log::info('Start Date: ' . $startDate);
// \Log::info('End Date: ' . $endDate);
    

 
    return [
        'datasets' => [
            [
                'label' => 'Pengeluaran per Hari',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

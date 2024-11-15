<?php

namespace App\Filament\Widgets;
use Illuminate\Support\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Transaction;
class WidgetsPemasukanChart extends ChartWidget
{
    use InteractsWithPageFilters;
    protected static ?string $heading = 'Pemasukan';
    protected static string $color = 'success';
    protected function getData(): array
    {
        $startDate = ! is_null($this->filters['startDate'] ?? null) ?
        Carbon::parse($this->filters['startDate']) :
        null;
        $endDate = ! is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            now();

        $filteredQuery = Transaction::where('pemasukan', true);
        $data = Trend::query($filteredQuery)
        ->between(
            start: $startDate,
            end: $endDate,
        )
        ->perMonth()
        ->sum('jumlah');
 
    return [
        'datasets' => [
            [
                'label' => 'Pemasukan per Hari',
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

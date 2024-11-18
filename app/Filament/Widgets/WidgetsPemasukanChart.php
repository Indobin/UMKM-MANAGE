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
        $startDate = !empty($this->filters['startDate'])
        ? Carbon::parse($this->filters['startDate'])
        : now()->startOfYear(); 

    $endDate = !empty($this->filters['endDate'])
        ? Carbon::parse($this->filters['endDate'])
        : now(); 
        

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

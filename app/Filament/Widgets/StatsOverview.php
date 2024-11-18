<?php

namespace App\Filament\Widgets;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Transaction;
class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    protected function getStats(): array
    {
        $startDate = !empty($this->filters['startDate'])
        ? Carbon::parse($this->filters['startDate'])
        : now()->startOfYear(); 

    $endDate = !empty($this->filters['endDate'])
        ? Carbon::parse($this->filters['endDate'])
        : now(); 

        $pemasukan = Transaction::where('pemasukan', true)
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->sum('jumlah');

        $pengeluaran = Transaction::where('pemasukan', false)
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->sum('jumlah');

        return [
            Stat::make('Total Pemasukan', 'RP.'.' '.$pemasukan)
                ->color('success'),
                // ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Total Pengeluaran','RP.'.' '.$pengeluaran),
                // ->numeric()
                // ->money('IDR', locale:'id'),
                // ->descriptionIcon('heroicon-m-arrow-trending-down'),
            Stat::make('Selisih','RP.'.' '. $pemasukan - $pengeluaran)
                // ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}

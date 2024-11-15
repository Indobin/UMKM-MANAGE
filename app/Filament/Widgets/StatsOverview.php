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
        $startDate = ! is_null($this->filters['startDate'] ?? null) ?
        Carbon::parse($this->filters['startDate']) :
        null;
        $endDate = ! is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            now();

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
            Stat::make('Selisih', $pemasukan - $pengeluaran)
                // ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}

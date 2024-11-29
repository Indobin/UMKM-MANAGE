<?php

namespace App\Filament\Resources\TransactionProductResource\Widgets;

use Filament\Widgets\Widget;
use App\Models\TransactionProduct;

class WidgetTransactionDetail extends Widget
{
    protected static string $view = 'filament.resources.transaction-product-resource.widgets.widget-transaction-detail';
    public TransactionProduct $transaction;

    public function mount(TransactionProduct $transaction)
    {
        $this->transaction = $transaction;
    }
}

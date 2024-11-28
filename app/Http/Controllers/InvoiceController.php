<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use App\Models\TransactionProduct;

class InvoiceController extends Controller
{
    public function generateInvoice($id)
    {
        // Data yang akan dikirim ke view PDF
        $transaction = TransactionProduct::find($id);
        $details = $transaction->details;

        // Membuat PDF dari view
        $pdf = Pdf::loadView('invoices.print', compact('transaction', 'details'));

        // Menyimpan PDF ke file atau mengirimnya langsung sebagai response
        // return $pdf->download('invoice.pdf');
        return $pdf->stream('invoice.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\Invoice; // Sesuaikan dengan namespace dan nama model Invoice Anda

class InvoiceController extends Controller
{
    public function print($id)
    {
        $invoice = Invoice::find($id);
        // Lakukan proses pencetakan invoice (contoh menggunakan Dompdf)
        $pdf = new Dompdf();
        $pdf->loadHtml(view('invoice', ['invoice' => $invoice])->render());
        $pdf->render();
        return $pdf->stream('invoice.pdf');
    }
}

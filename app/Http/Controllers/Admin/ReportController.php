<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\ProductsExport;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Product;
use App\Models\Transaction;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function exportProductsExcel()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function exportProductsPdf()
    {
        $products = Product::all();
        $pdf = Pdf::loadView('admin.reports.products_pdf', compact('products'));
        return $pdf->download('products.pdf');
    }

    public function exportTransactionsExcel()
    {
        return Excel::download(new TransactionsExport, 'transactions.xlsx');
    }

    public function exportTransactionsPdf()
    {
        $transactions = Transaction::all();
        $pdf = Pdf::loadView('admin.reports.transactions_pdf', compact('transactions'));
        return $pdf->download('transactions.pdf');
    }
}

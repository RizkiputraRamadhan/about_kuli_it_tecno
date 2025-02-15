<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        $currentYear = Carbon::now()->year;
        $transactionGrowth = Transaction::selectRaw('MONTH(created_at) as month, COUNT(*) as total')->whereYear('created_at', $currentYear)->groupBy('month')->orderBy('month')->get()->pluck('total', 'month');
        $data = [
            'transaction' => Transaction::orderBy('id', 'desc')->paginate(20),
            'counts' => Transaction::count(),
            'transactionGrowth' => $transactionGrowth,
            
        ];
        return view('pages.Admin.v_transaction.index', $data)->with('page', 'transaction');
    }

    public function show($id)
    {
        $data = [
            'transaction' => Transaction::find($id),
        ];
        return view('pages.Admin.v_transaction.show', $data)->with('page', 'transaction');
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();
        
        return redirect()->back()->with('success', 'Berhasil dihapus');
    }
}

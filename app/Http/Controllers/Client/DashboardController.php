<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\SourceCodes;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $currentYear = Carbon::now()->year;
        $transactionGrowth = Transaction::selectRaw('MONTH(created_at) as month, COUNT(*) as total')->where('user_id', Auth::id())->whereYear('created_at', $currentYear)->groupBy('month')->orderBy('month')->get()->pluck('total', 'month');
        $data = [
            'success' => Transaction::where('user_id', Auth::id())->where('transaction_status', 'success')->count(),
            'pending' => Transaction::where('user_id', Auth::id())->where('transaction_status', 'pending')->count(),
            'failed' => Transaction::where('user_id', Auth::id())->where('transaction_status', 'failed')->count(),
            'transactionGrowth' => $transactionGrowth,
        ];
        return view('pages.Client.Dashboard.v_home.index', $data)->with('page', 'dashboard');
    }

    public function transaction() {
        $transaction = Transaction::where('user_id', Auth::id())->paginate(20);
        $data = [
            'transaction' => $transaction,
        ];
        return view('pages.Client.Dashboard.v_source_code.index', $data)->with('page', 'transaction');
    }
}

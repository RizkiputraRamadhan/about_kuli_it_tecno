<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\SourceCodes;

class DashboardController extends Controller
{
    public function index() {
        $currentYear = Carbon::now()->year;
        $transactionGrowth = Transaction::selectRaw('MONTH(created_at) as month, COUNT(*) as total')->whereYear('created_at', $currentYear)->groupBy('month')->orderBy('month')->get()->pluck('total', 'month');
        $data = [
            'users' => User::count(),
            'transaction' => Transaction::count(),
            'sources' => SourceCodes::count(),
            'transactionGrowth' => $transactionGrowth,
        ];
        return view('pages.Admin.dashboard', $data)->with('page', 'dashboard');
    }
}

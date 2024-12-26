<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $data = [
            'users' => User::count(),
        ];
        return view('pages.Admin.dashboard', $data);
    }
}

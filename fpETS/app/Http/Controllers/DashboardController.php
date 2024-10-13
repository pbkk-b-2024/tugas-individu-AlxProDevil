<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'staff') {
            return view('dashboards.staff');
        }

        return view('dashboards.user');
    }
}
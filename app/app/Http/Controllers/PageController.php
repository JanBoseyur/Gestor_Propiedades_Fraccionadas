<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function Login()
    {
        return view('login');
    }

    public function Register()
    {
        return view('auth.register');
    }

    public function AdminDashboard()
    {
        $user = Auth::user();
        return view('admin.admin-dashboard', compact('user'));
    }

    public function ManageProperties()
    {
        return view('admin.manage-properties');
    }

    public function ManagePartners()
    {
        return view('admin.manage-partners');
    }

    public function ReservedWeeks()
    {
        return view('admin.reserved-weeks');
    }

    public function BillingPage()
    {
        return view('admin.billing-page');
    }
}


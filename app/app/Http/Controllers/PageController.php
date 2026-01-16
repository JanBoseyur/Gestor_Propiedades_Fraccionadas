<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

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
        return view('admin.admin-dashboard');
    }

    public function ManageProperties()
    {
        return view('admin.manage-properties');
    }

    public function ManagePartners()
    {
        return view('admin.manage-properties');
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


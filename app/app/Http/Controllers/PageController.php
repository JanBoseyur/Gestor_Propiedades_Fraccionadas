<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function Login()
    {
        return view('Login');
    }

    public function Register()
    {
        return view('auth.Register');
    }

    public function AdminDashboard()
    {
        return view('admin.AdminDashboard');
    }

    public function ManageProperties()
    {
        return view('admin.ManageProperties');
    }

    public function ManagePartners()
    {
        return view('admin.ManagePartners');
    }

    public function ReservedWeeks()
    {
        return view('admin.ReservedWeeks');
    }

    public function BillingPage()
    {
        return view('admin.BillingPage');
    }
}


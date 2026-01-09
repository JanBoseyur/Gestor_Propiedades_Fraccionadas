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

    public function AdminPropertyDetails()
    {
        return view('admin.AdminPropertyDetails');
    }

    public function ManagePartners()
    {
        return view('admin.ManagePartners');
    }
}


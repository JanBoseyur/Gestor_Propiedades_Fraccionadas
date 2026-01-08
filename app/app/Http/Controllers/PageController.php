<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function AdminDashboard()
    {
        return view('admin.AdminDashboard');
    }

    public function AdminPropertyDetails()
    {
        return view('admin.AdminPropertyDetails');
    }
}

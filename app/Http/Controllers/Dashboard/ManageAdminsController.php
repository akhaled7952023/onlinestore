<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ManageAdminsController extends Controller
{
         public function index()
    {
        $admins = Admin::with('roles')->paginate(10);
        return view('dashboard.admins.index' , compact('admins'));
    }
}

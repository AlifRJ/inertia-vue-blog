<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Dashboard',[
        'user' => User::where("username", "AlifRJ")->get(),
    ]);
    }
}

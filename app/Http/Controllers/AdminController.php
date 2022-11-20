<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* Checks if user is authenticated */
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('admin.index');
    }
}

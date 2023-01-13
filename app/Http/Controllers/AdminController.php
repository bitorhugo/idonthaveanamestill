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
        /**
         * The order matters for logic reason
         * first check if is admin
         * then verify email
         */
        $this->middleware('isAdmin');
        $this->middleware('verified');
    }

    
    public function index()
    {
        return view('admin.index');
    }
}

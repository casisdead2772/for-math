<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;


class HomeController extends Controller
{
    protected $subjectService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminPanel()
    {
        try {
            $users = User::all();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return view('admin.admin-panel', compact(['users']));
    }
}

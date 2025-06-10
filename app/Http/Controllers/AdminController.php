<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $completedMikatTest = User::whereNotNull('test_mikat')->count();
        $completedTestSosec = User::whereNotNull('test_sosec')->count();
        
        return view('admin.dashboard', compact('totalUsers', 'completedMikatTest', 'completedTestSosec'));
    }

    /**
     * Show list of users and their test status.
     *
     * @return \Illuminate\View\View
     */
    public function usersList()
    {
        $users = User::select('id', 'name', 'email', 'test_mikat', 'test_sosec')->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show user details
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showUser($id)
    {
        $user = User::findOrFail($id);
        
        return view('admin.users.show', compact('user'));
    }
} 
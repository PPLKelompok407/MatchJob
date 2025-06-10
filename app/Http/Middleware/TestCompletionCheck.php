<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class TestCompletionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        try {
            // Check if user has completed both tests
            $mikatCompleted = !empty($user->test_mikat);
            $sosecCompleted = !empty($user->test_sosec);
            $addressFilled = !empty($user->alamat);
            
            if (!$mikatCompleted || !$sosecCompleted) {
                return redirect()->route('pages.dashboard')
                    ->with('test_required', 'Anda harus menyelesaikan Test Softskill dan Test Minat Bakat terlebih dahulu!');
            }
            
            if (!$addressFilled) {
                // Set the session flag for SweetAlert
                session()->flash('address_required', true);
                session()->flash('address_message', 'Anda harus mengisi alamat pada profil Anda terlebih dahulu!');
                
                // Redirect to profile edit page
                return redirect()->route('pages.profile.editData');
            }
        } catch (\Exception $e) {
            // If there's any database error, assume requirements not met
            return redirect()->route('pages.dashboard')
                ->with('test_required', 'Anda harus menyelesaikan Test Softskill dan Test Minat Bakat terlebih dahulu!');
        }
        
        return $next($request);
    }
} 
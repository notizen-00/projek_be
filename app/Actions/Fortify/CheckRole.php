<?php 

namespace App\Actions\Fortify;

use Laravel\Fortify\Actions\PrepareAuthenticatedSession as FortifyPrepareAuthenticatedSession;
use App\Models\User;
class CheckRole extends FortifyPrepareAuthenticatedSession
{
    /**
     * Handle the authenticated request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    public function handle($request, $next)
    {   

        $user = User::where('email', $request->email)->first();

        if ($user->role === 'penjual') {
            return redirect()->route('dashboard'); 
        } elseif ($user->role === 'pembeli') {
            return redirect()->route('dashboard'); 
        }

        return $next($request);
    }
}
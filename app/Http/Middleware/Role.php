<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\User;



class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {


        if (Auth::check()) {

/* figyelem.
Ez a rész a gyorsítótárat (cache) használja a felhasználói online állapot tárolására. Az expireTime változó az aktuális időponthoz hozzáad 30 másodpercet, így a gyorsítótárban tárolt adat 30 másodpercig lesz érvényes. A Cache::put() metódus hozzáadja az 'user-is-online' . Auth::user()->id kulcsot a gyorsítótárhoz, amely az adott felhasználót azonosítja. Az érték true, ami jelzi, hogy a felhasználó online állapotban van.
A felhasználó táblájában frissíti a last_seen oszlopot az aktuális időpontra. Az User::where() metódus megtalálja a felhasználót az id alapján, és az update() metódus frissíti a last_seen oszlopot a jelenlegi időpontra, amelyet a Carbon::now() függvény ad vissza.

*/
            $expireTime = Carbon::now()->addSeconds(30);
            Cache::put('user-is-online' . Auth::user()->id, true, $expireTime); 
            User::where('id', Auth::user()->id)->update([
                'last_seen' => Carbon::now()
            ]);

        }



        if($request->user()->role !== $role){
            return redirect('dashboard');
        }
        

        return $next($request);
    }
}

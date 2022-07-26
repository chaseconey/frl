<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureDiscordAuthed
{
    /**
     * Ensure user has linked discord account
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->user()->discord_user_id) {
            return redirect()->route('auth.discord');
        }

        return $next($request);
    }
}

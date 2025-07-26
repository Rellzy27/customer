<?php

namespace App\Http\Middleware;

use App\Models\Pesanan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TicketOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth_check = Auth::guard('pelanggan')->user()->kd_pelanggan;
        $ticket = $request->route('ticket'); // assuming the ticket is passed as a route parameter

        if (Pesanan::find($ticket) == null || $auth_check != Pesanan::find($ticket)->kd_pelanggan) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}

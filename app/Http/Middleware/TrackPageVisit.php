<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $pageKey): Response
    {
        // Increment per-day counter for provided page key
        try {
            $today = Carbon::today();
            /** @var PageVisit $row */
            $row = PageVisit::firstOrCreate([
                'page' => $pageKey,
                'date' => $today->toDateString(),
            ], [
                'count' => 0,
            ]);

            // Use atomic increment to avoid race conditions
            PageVisit::where('id', $row->id)->increment('count');
        } catch (\Throwable $e) {
            // Fail-safe: never block the request due to stats
        }

        return $next($request);
    }
}

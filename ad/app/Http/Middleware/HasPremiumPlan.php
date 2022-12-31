<?php

namespace App\Http\Middleware;

use App\Models\Package;
use App\Models\Payment;
use Closure;
use Illuminate\Http\Request;

class HasPremiumPlan
{
    public $activatedPostsExpiration;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userPosts = auth()->user()->posts;
        foreach($userPosts as $post){
                $payment = Payment::where('post_id', $post->id)
                    ->whereIn('package_id', [6,7]) // gold and silver plan
                    ->orderByDesc('id')
                    ->first();
                    if(!empty($payment)) break;
        }

        if(empty($payment)) return redirect()->back();
        return $next($request);
    }
}

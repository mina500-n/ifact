<?php

namespace App\Http\Controllers;

use App\Models\NewsCheck;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $total     = NewsCheck::where('user_id', $userId)->count();
        $fakeCount = NewsCheck::where('user_id', $userId)->where('result', 'fake')->count();
        $realCount = NewsCheck::where('user_id', $userId)->where('result', 'real')->count();
        $uncertain = NewsCheck::where('user_id', $userId)->where('result', 'uncertain')->count();
        $avgScore  = NewsCheck::where('user_id', $userId)->avg('credibility_score');

        $last7Days = collect(range(6, 0))->map(function ($daysAgo) use ($userId) {
            $date = now()->subDays($daysAgo);
            return [
                'date'  => $date->format('M d'),
                'count' => NewsCheck::where('user_id', $userId)
                                    ->whereDate('created_at', $date)
                                    ->count(),
            ];
        });

        $sentiments = NewsCheck::where('user_id', $userId)
            ->whereNotNull('sentiment')
            ->selectRaw('sentiment, count(*) as total')
            ->groupBy('sentiment')
            ->pluck('total', 'sentiment');

        $recent = NewsCheck::where('user_id', $userId)
                           ->latest()
                           ->take(5)
                           ->get();

        return view('dashboard', compact(
            'total', 'fakeCount', 'realCount', 'uncertain',
            'avgScore', 'last7Days', 'sentiments', 'recent'
        ));
    }
}

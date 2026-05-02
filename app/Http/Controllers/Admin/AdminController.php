<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCheck;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers       = User::count();
        $totalSubmissions = NewsCheck::count();
        $fakeCount        = NewsCheck::where('result', 'fake')->count();
        $realCount        = NewsCheck::where('result', 'real')->count();
        $uncertainCount   = NewsCheck::where('result', 'uncertain')->count();
        $avgScore         = round(NewsCheck::avg('credibility_score') ?? 0, 1);

        // Submissions per day — last 14 days
        $last14Days = collect(range(13, 0))->map(function ($daysAgo) {
            $date = now()->subDays($daysAgo);
            return [
                'date'  => $date->format('M d'),
                'count' => NewsCheck::whereDate('created_at', $date)->count(),
            ];
        });

        // Top users by submission count
        $topUsers = User::withCount('newsChecks')
                        ->orderByDesc('news_checks_count')
                        ->take(5)
                        ->get();

        // Recent submissions
        $recentSubmissions = NewsCheck::with('user')
                                      ->latest()
                                      ->take(8)
                                      ->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalSubmissions', 'fakeCount',
            'realCount', 'uncertainCount', 'avgScore',
            'last14Days', 'topUsers', 'recentSubmissions'
        ));
    }

    public function users()
    {
        $users = User::withCount('newsChecks')
                     ->latest()
                     ->paginate(15);

        return view('admin.users', compact('users'));
    }

    public function submissions()
    {
        $submissions = NewsCheck::with('user')
                                ->latest()
                                ->paginate(15);

        return view('admin.submissions', compact('submissions'));
    }

    public function deleteUser(User $user)
    {
        if ($user->is_admin) {
            return back()->withErrors(['error' => 'Cannot delete an admin user.']);
        }
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function deleteSubmission(NewsCheck $newsCheck)
    {
        $newsCheck->delete();
        return back()->with('success', 'Submission deleted successfully.');
    }
}

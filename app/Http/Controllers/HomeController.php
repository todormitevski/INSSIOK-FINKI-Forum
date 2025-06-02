<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Post;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $majors = Major::withCount('subjects')->get();

        $recentPosts = Post::with(['subject', 'user'])
            ->latest()
            ->take(10)
            ->get();

        $popularSubjects = Subject::withCount('posts')
            ->orderByDesc('posts_count')
            ->take(5)
            ->get();

        $activeUsers = User::withCount('posts')
            ->orderByDesc('posts_count')
            ->take(5)
            ->get();

        $stats = [
            'total_posts' => Post::count(),
            'total_users' => User::count(),
            'total_subjects' => Subject::count(),
            'today_posts' => Post::whereDate('created_at', today())->count(),
        ];

        return view('welcome', compact(
            'majors',
            'recentPosts',
            'popularSubjects',
            'activeUsers',
            'stats'
        ));
    }
}

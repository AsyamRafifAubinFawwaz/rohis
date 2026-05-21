<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(): mixed
    {
        $user = auth()->user();

        $totalPosts = $user->posts()->count();
        $pendingPosts = $user->posts()->where('status', 'pending')->count();
        $publishedPosts = $user->posts()->where('status', 'published')->count();
        $totalGalleries = $user->galleries()->count();

        $recentPosts = $user->posts()
            ->with('categories')
            ->latest()
            ->limit(5)
            ->get();

        $recentGalleries = $user->galleries()
            ->with('activity')
            ->latest()
            ->limit(6)
            ->get();

        $page = ['title' => 'Dashboard'];

        return view('_admin.dashboard', compact(
            'totalPosts',
            'pendingPosts',
            'publishedPosts',
            'totalGalleries',
            'recentPosts',
            'recentGalleries',
            'page'
        ));
    }
}

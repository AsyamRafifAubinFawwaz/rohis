<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Galleries;
use App\Models\Posts;
use App\Models\Programs;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = ['title' => 'Dashboard'];

        $stats = [
            'total_users' => User::count(),
            'total_posts' => Posts::count(),
            'total_galleries' => Galleries::count(),
            'total_programs' => Programs::count(),
        ];

        $pending_posts = Posts::where('status', 'pending')
            ->with(['user', 'categories'])
            ->latest()
            ->limit(5)
            ->get();

        $latest_galleries = Galleries::with('creator')
            ->latest()
            ->limit(8)
            ->get();

        // Chart Data: Post Status Distribution
        $post_status_counts = Posts::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        // Ensure all possible statuses are present for the chart
        $statuses = ['published', 'pending', 'rejected', 'draft'];
        $chart_data = [];
        foreach ($statuses as $status) {
            $chart_data[$status] = $post_status_counts[$status] ?? 0;
        }

        return view('_superadmin.dashboard.index', compact(
            'page',
            'stats',
            'pending_posts',
            'latest_galleries',
            'chart_data'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

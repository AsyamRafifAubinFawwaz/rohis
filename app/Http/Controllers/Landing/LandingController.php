<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Announcements;
use App\Models\Galleries;
use App\Models\Posts;
use App\Models\Profiles;
use App\Models\Programs;

class LandingController extends Controller
{
    /**
     * Landing page / Beranda.
     */
    public function index()
    {
        $about = Profiles::query()->where('type', 'about')->first();

        $programs = Programs::query()
            ->latest()
            ->limit(4)
            ->get();

        $articles = Posts::query()
            ->where('status', 'published')
            ->with('user', 'categories')
            ->latest()
            ->limit(3)
            ->get();

        $galleries = Galleries::query()
            ->latest()
            ->limit(8)
            ->get();

        $announcements = Announcements::query()
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            })
            ->latest()
            ->limit(3)
            ->get();

        $activities = Activities::query()
            ->whereNotNull('event_start')
            ->where('event_start', '>=', now())
            ->orderBy('event_start')
            ->limit(3)
            ->get();

        return view('_landing.index', compact(
            'about',
            'programs',
            'articles',
            'galleries',
            'announcements',
            'activities',
        ));
    }
}

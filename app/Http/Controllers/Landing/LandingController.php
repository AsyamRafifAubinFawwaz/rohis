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
        $profiles = Profiles::all()->keyBy('type');
        $about = $profiles->get('about');
        $vision = $profiles->get('vision');
        $mission = $profiles->get('mission');
        $structure = $profiles->get('structure');

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
            'vision',
            'mission',
            'structure',
            'programs',
            'articles',
            'galleries',
            'announcements',
            'activities',
        ));
    }

    public function articles()
    {
        $articles = Posts::where('status', 'published')->latest()->paginate(12);

        return view('_landing.articles.index', compact('articles'));
    }

    public function articleDetail($slug)
    {
        $article = Posts::where('slug', $slug)->where('status', 'published')->firstOrFail();

        return view('_landing.articles.detail', compact('article'));
    }

    public function programs()
    {
        $programs = Programs::latest()->paginate(12);

        return view('_landing.programs.index', compact('programs'));
    }

    public function programDetail($id)
    {
        $program = Programs::findOrFail($id);

        return view('_landing.programs.detail', compact('program'));
    }

    public function galleries()
    {
        $galleries = Galleries::latest()->paginate(24);

        return view('_landing.galleries.index', compact('galleries'));
    }

    public function announcements()
    {
        $announcements = Announcements::latest()->paginate(15);

        return view('_landing.announcements.index', compact('announcements'));
    }

    public function announcementDetail($id)
    {
        $announcement = Announcements::findOrFail($id);

        return view('_landing.announcements.detail', compact('announcement'));
    }

    public function activities()
    {
        $activities = Activities::orderBy('event_start', 'desc')->paginate(12);

        return view('_landing.activities.index', compact('activities'));
    }

    public function activityDetail($id)
    {
        $activity = Activities::findOrFail($id);

        return view('_landing.activities.detail', compact('activity'));
    }
}

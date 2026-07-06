<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Announcements;
use App\Models\Galleries;
use App\Models\Posts;
use App\Models\Profiles;
use App\Models\Programs;
use App\Models\organizer;
use Illuminate\Http\Request;

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
            ->with('galleries')
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

    public function articles(\Illuminate\Http\Request $request)
    {
        $query = Posts::where('status', 'published')->with('categories');

        if ($request->filled('category') && $request->category !== 'all') {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('sort') && $request->sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        if ($request->ajax() || $request->has('partial')) {
            $cacheKey = 'articles_grid_' . md5($request->fullUrl());
            $html = \Illuminate\Support\Facades\Cache::remember($cacheKey, 60, function () use ($query) {
                $articles = $query->paginate(12)->withQueryString();
                return view('_landing.articles.partials.grid', compact('articles'))->render();
            });
            return $html;
        }

        $articles = collect();
        $categories = \Illuminate\Support\Facades\Cache::remember('articles_categories', 3600, function () {
            return \App\Models\Categories::all();
        });

        return view('_landing.articles.index', compact('articles', 'categories'));
    }

    public function articleDetail($slug)
    {
        $article = Posts::where('slug', $slug)->where('status', 'published')->firstOrFail();

        $otherArticles = Posts::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->latest()
            ->limit(5)
            ->get();

        $categories = \App\Models\Categories::withCount(['posts' => function($q) {
            $q->where('status', 'published');
        }])->get();

        return view('_landing.articles.detail', compact('article', 'otherArticles', 'categories'));
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
        $announcements = Announcements::query()
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            })
            ->latest()
            ->paginate(15);

        return view('_landing.announcements.index', compact('announcements'));
    }

    public function announcementDetail($slug)
    {
        $announcement = Announcements::where('slug', $slug)->firstOrFail();

        return view('_landing.announcements.detail', compact('announcement'));
    }

    public function activities(Request $request)
    {
        $query = clone Activities::with('galleries')->orderBy('event_start', 'desc');
        
        if ($request->ajax() || $request->has('partial')) {
            $cacheKey = 'activities_grid_' . md5($request->fullUrl());
            $html = \Illuminate\Support\Facades\Cache::remember($cacheKey, 60, function () use ($query) {
                $activities = $query->paginate(12);
                return view('_landing.activities.partials.grid', compact('activities'))->render();
            });
            return $html;
        }

        $activities = collect();
        return view('_landing.activities.index', compact('activities'));
    }

    public function activityDetail($slug)
    {
        $activity = Activities::with('galleries')->where('slug', $slug)->firstOrFail();

        return view('_landing.activities.detail', compact('activity'));
    }

    public function visionMission()
    {
        $profiles = Profiles::all()->keyBy('type');
        $vision = $profiles->get('vision');
        $mission = $profiles->get('mission');

        return view('_landing.profiles.vision-mission', compact('vision', 'mission'));
    }

    public function organizers(Request $request)
    {
        $query = organizer::query();

        $latestPeriod = organizer::max('periode');
        $selectedPeriode = $request->has('periode') ? $request->periode : $latestPeriod;

        if ($selectedPeriode && $selectedPeriode !== 'all') {
            $query->where('periode', $selectedPeriode);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('jabatan', 'like', '%' . $request->search . '%');
            });
        }

        $query->orderByRaw("CASE 
            WHEN jabatan = 'Pembina' THEN 1 
            WHEN jabatan = 'Ketua' THEN 2 
            WHEN jabatan = 'Wakil Ketua' THEN 3 
            WHEN jabatan = 'Sekretaris 1' THEN 4 
            WHEN jabatan = 'Sekretaris 2' THEN 5 
            WHEN jabatan = 'Bendahara' THEN 6 
            WHEN jabatan = 'Media' THEN 7 
            WHEN jabatan = 'Anggota' THEN 8 
            ELSE 9 
        END");

        // Default sorting
        if ($request->filled('sort') && $request->sort === 'oldest') {
            $query->oldest('id'); 
        } else {
            $query->latest('id');
        }

        $organizers = $query->paginate(12)->withQueryString();
        
        $periods = organizer::select('periode')->distinct()->whereNotNull('periode')->pluck('periode')->sortDesc();

        return view('_landing.organizers.index', compact('organizers', 'periods', 'selectedPeriode'));
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Site;
use Illuminate\Support\Facades\Log;


class SiteController extends Controller {
    public function index() {
        $sites = Site::all();
        return view('sites.index', compact('sites'));
    }

    public function store(Request $request) {
        Site::create($request->validate(['name' => 'required', 'url' => 'required|url']));
        return redirect()->route('sites.index');
    }
    public function getCsrfToken(Request $request) {
        $siteUrl = $request->header('Referer') ?? $request->header('Origin');

        if (!$siteUrl) {
            return response()->json(['error' => 'URL not found'], 400);
        }

        $parsedUrl = parse_url($siteUrl);
        $baseUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
        Log::info('Текущее значение переменной:', ['variable' => $baseUrl]);
        $site = Site::where('url', $baseUrl)->first();

        if (!$site) {
            return response()->json(['error' => 'Unauthorized site'], 403);
        }

        return response()->json(['csrf_token' => csrf_token()]);
    }
}


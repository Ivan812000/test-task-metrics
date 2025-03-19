<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Click;
use Carbon\Carbon;

class ClickController extends Controller {
    public function store(Request $request) {
        $data = $request->validate([
            'site_id' => 'required|string',
            'x' => 'required|integer',
            'y' => 'required|integer',
            'url' => 'required|string',
            'timestamp' => 'required|date',
        ]);

        $data['timestamp'] = Carbon::parse($data['timestamp'])->format('Y-m-d H:i:s');

        Click::create($data);
        return response()->json(['status' => 'success']);
    }

    public function getClicks($site_id) {
        return response()->json(Click::where('site_id', $site_id)->get());
    }
    public function showClicksMap($site_id)
    {
        return view('sites.clicks', ['site_id' => $site_id]);
    }
    public function getClickStats($site_id) {
        $clicksByHour = Click::where('site_id', $site_id)
            ->selectRaw('HOUR(timestamp) as hour, COUNT(*) as count')  // Группируем по часам
            ->groupBy('hour')
            ->orderBy('hour', 'asc')
            ->get();

        return response()->json($clicksByHour);
    }
    public function showStats($site_id)
    {
        return view('sites.stats', ['site_id' => $site_id]);
    }
}


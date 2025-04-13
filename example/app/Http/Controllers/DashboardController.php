<?php

namespace App\Http\Controllers;

use App\Models\Analytic;
use App\Services\AnalyticService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(AnalyticService $analyticService): View
    {
        $analyticService->processDailyData();
        $seedData = Analytic::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(seed_input) as total_seed_input'),
            DB::raw('SUM(seed_response) as total_seed_response')
        )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()->map(function ($item) {
                return [
                    'year' => $item->year,
                    'month' => Carbon::createFromDate($item->month)->format('F'),
                    'total_seed_input' => $item->total_seed_input,
                    'total_seed_response' => $item->total_seed_response,
                ];
            });

        return view('welcome', compact('seedData'));
    }
}

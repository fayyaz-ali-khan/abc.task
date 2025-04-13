<?php

// app/Services/FacebookAnalyticsService.php

namespace App\Services;

use App\Models\Analytic;
use Illuminate\Support\Facades\Storage;

class AnalyticService
{
    public function processDailyData(): void
    {

        $this->processData('analytics/facebook_analytics.json', 'facebook');
        $this->processData('analytics/instagram_analytics.json', 'instagram');
        $this->processData('analytics/snapshot_analytics.json', 'snapshort');
    }

    private function processData(string $filePath, string $platform): void
    {
        $today = now()->format('Y-m-d');
        $jsonData = json_decode(Storage::get($filePath), true);
        $todayData = collect($jsonData)->firstWhere('date', $today);

        if ($todayData) {
            $existingRecord = Analytic::whereDate('created_at', $today)->first();

            if ($existingRecord) {
                $data = [
                    'seed_input' => $existingRecord->seed_input + $todayData['seed_input'],
                    'seed_response' => $existingRecord->seed_response + $todayData['seed_response'],
                    'session_adjustment' => $existingRecord->session_adjustment + $todayData['session_adjustment'],
                    'engagement_adjustment' => $existingRecord->engagement_adjustment + $todayData['engagement_adjustment'],
                    'iphone_adjustment' => $existingRecord->iphone_adjustment + $todayData['iphone_adjustment'],
                    'android_adjustment' => $existingRecord->android_adjustment + $todayData['android_adjustment'],
                    'pc_adjustment' => $existingRecord->pc_adjustment + $todayData['pc_adjustment'],
                ];
                if ($platform === 'facebook') {
                    $data['facebook_visitor'] = $existingRecord->facebook_visitor + $todayData['facebook_visitor'];
                } elseif ($platform === 'instagram') {
                    $data['instagram_visitor'] = $existingRecord->instagram_visitor + $todayData['instagram_visitor'];
                } elseif ($platform === 'snapshort') {
                    $data['snapshort_visitor'] = $existingRecord->snapshort_visitor + $todayData['snapshort_visitor'];
                }
                $existingRecord->update();
            } else {
                Analytic::create([
                    'seed_input' => $todayData['seed_input'],
                    'seed_response' => $todayData['seed_response'],
                    $platform.'_visitor' => $todayData[$platform.'_visitor'],
                    'session_adjustment' => $todayData['session_adjustment'],
                    'engagement_adjustment' => $todayData['engagement_adjustment'],
                    'iphone_adjustment' => $todayData['iphone_adjustment'],
                    'android_adjustment' => $todayData['android_adjustment'],
                    'pc_adjustment' => $todayData['pc_adjustment'],
                ]);
            }
        }
    }
}

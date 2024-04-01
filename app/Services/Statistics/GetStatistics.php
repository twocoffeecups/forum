<?php

namespace App\Services\Statistics;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

trait GetStatistics
{
    protected function getDailyVisitors()
    {
        $data =
            DB::table('daily_visitors')
                ->selectRaw("COUNT(*) as data, DATE_FORMAT(created_at, '%d %M %Y') as labels")
                ->groupBy('labels')
                ->limit(10)
                ->get();

        return $this->formatToChartObject($data);
    }

    protected function getTopicForums()
    {
        $data =
            DB::table('topics')
                ->join('forums', 'topics.forumId', '=', 'forums.id')
                ->selectRaw('COUNT(*) as data, forums.name as labels')
                ->groupBy('labels')
                ->get();

        foreach ($data as $key => $value){
            $colors[] = sprintf('#%06X', mt_rand($key, 0xFFFFFF));
        }

        return $this->formatToChartObject($data, $colors);
    }

    protected function formatToChartObject($data, string|array $colors = '#2563eb'): array
    {
        $chartObject = [
            'labels' => array_column($data->toArray(), 'labels'),
            'datasets' => [
                [
                    'backgroundColor' => $colors,
                    'label' => 'Topic forums',
                    'data' => array_column($data->toArray(), 'data'),
                ],
            ],
        ];

        return $chartObject;
    }

}

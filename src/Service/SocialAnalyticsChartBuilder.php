<?php

declare(strict_types=1);

namespace App\Service;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

final class SocialAnalyticsChartBuilder
{
    /**
     * @param list<array{label:string,likes:int,dislikes:int,shares:int}> $dailyStats
     */
    public function buildDailyEngagementChart(array $dailyStats): ColumnChart
    {
        $chart = new ColumnChart();

        $data = [['Day', 'Likes', 'Dislikes', 'Shares']];
        foreach ($dailyStats as $stat) {
            $data[] = [
                (string) $stat['label'],
                (int) $stat['likes'],
                (int) $stat['dislikes'],
                (int) $stat['shares'],
            ];
        }

        $chart->getData()->setArrayToDataTable($data);
        $chart->getOptions()
            ->setTitle('Daily engagement over the last 7 days')
            ->setHeight(360)
            ->setColors(['#42664f', '#8f3a3a', '#cd6b38']);
        $chart->getOptions()->getLegend()->setPosition('top');
        $chart->getOptions()->getHAxis()->setTitle('Day');
        $chart->getOptions()->getVAxis()->setTitle('Interactions');
        $chart->getOptions()->getChartArea()
            ->setLeft(72)
            ->setTop(56)
            ->setWidth('80%')
            ->setHeight('70%');

        return $chart;
    }

    /**
     * @param array{posts:int,likes:int,dislikes:int,shares:int,comments:int} $overview
     */
    public function buildEngagementBreakdownChart(array $overview): PieChart
    {
        $chart = new PieChart();

        $data = [['Type', 'Total']];
        $colors = [];
        $segments = [
            ['Likes', (int) $overview['likes'], '#42664f'],
            ['Dislikes', (int) $overview['dislikes'], '#8f3a3a'],
            ['Shares', (int) $overview['shares'], '#cd6b38'],
            ['Comments', (int) $overview['comments'], '#edc476'],
        ];

        foreach ($segments as [$label, $value, $color]) {
            if ($value <= 0) {
                continue;
            }

            $data[] = [$label, $value];
            $colors[] = $color;
        }

        if (count($data) === 1) {
            $data[] = ['No activity yet', 1];
            $colors[] = '#b6aea3';
        }

        $chart->getData()->setArrayToDataTable($data);
        $chart->getOptions()
            ->setTitle('Engagement distribution')
            ->setHeight(360)
            ->setPieHole(0.58)
            ->setColors($colors);
        $chart->getOptions()->getLegend()->setPosition('right');
        $chart->getOptions()->getChartArea()
            ->setLeft(16)
            ->setTop(36)
            ->setWidth('92%')
            ->setHeight('82%');

        return $chart;
    }
}

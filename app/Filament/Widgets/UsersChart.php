<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use App\Models\User;

class UsersChart extends ChartWidget
{
    protected static ?string $heading = 'Customers';
    protected static ?int $sort = 6;

    protected function getData(): array
    {
        $users = User::select('created_at')->where('role_id', 3)->get()->groupby(function($users) {
            return Carbon::parse($users->created_at)->format('F');
        });
        $quantities = [];
        foreach ($users as $user => $value) {
            array_push($quantities, $value->count());
        }
        return [
            'datasets' => [
                [
                    'label' => 'Customers Joined',
                    'data' => $quantities,
                    'fill' => 'start',
                    // 'backgroundColor' => [
                    //     'rgba(255, 99, 132, 0.2)',
                    //     'rgba(255, 159, 64, 0.2)',
                    //     'rgba(255, 205, 86, 0.2)',
                    //     'rgba(75, 192, 192, 0.2)',
                    //     'rgba(54, 162, 235, 0.2)',
                    //     'rgba(153, 102, 255, 0.2)',
                    //     'rgba(201, 203, 207, 0.2)'
                    // ],
                    // 'borderColor' => [
                    //     'rgb(255, 99, 132)',
                    //     'rgb(255, 159, 64)',
                    //     'rgb(255, 205, 86)',
                    //     'rgb(75, 192, 192)',
                    //     'rgb(54, 162, 235)',
                    //     'rgb(153, 102, 255)',
                    //     'rgb(201, 203, 207)'
                    // ],
                    // 'borderWidth' => 1
                ],
            ],
            'labels' => $users->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DataSourceController extends Controller
{
    public static function getWeatherData($lat, $lon)
    {
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $lat,
            'longitude' => $lon,
            'current' => 'temperature_2m,precipitation',
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return [
                'temperature' => $data['current']['temperature_2m'] ?? null,
                'precipitation' => $data['current']['precipitation'] ?? null,
                'time' => $data['current']['time'] ?? null,
            ];
        }

        return null;
    }
}

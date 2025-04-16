<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Summit;
use Illuminate\Support\Facades\Http;  // Αν χρησιμοποιείς το Http για API αιτήματα

class WeatherController extends Controller
{
    public function getSummitData($summitName)
{
    try {
        $response = Http::get("https://api.weather.com/v3/wx/conditions/current", [
            'query' => $summitName, // Θα πρέπει να βεβαιωθείς ότι το API το υποστηρίζει
        ]);

        if ($response->successful()) {
            $weatherData = $response->json();
            return response()->json($weatherData); // Επιστρέφει τα δεδομένα ως JSON
        } else {
            return response()->json(['error' => 'Σφάλμα στην ανάκτηση των δεδομφφφφένων.'], 500);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => 'Σφάλμα στην ανάκτηση των δεδσσσομένων. ' . $e->getMessage()], 500);
    }
}

}


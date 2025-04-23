<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\ClimateData;
use Illuminate\Support\Facades\Http;

class ClimateDataController extends Controller
{

    public function fetchClimateData(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
    
        $latitude = $validated['latitude'];
        $longitude = $validated['longitude'];
    
        // Κλήση στο Open-Meteo API
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'hourly' => 'temperature_2m',
            'timezone' => 'auto',
        ]);
    
        if ($response->failed()) {
            return back()->with('error', 'Αποτυχία λήψης δεδομένων από το API');
        }
    
        $data = $response->json();
    
        // Πάρε την πρώτη τιμή θερμοκρασίας (π.χ. την πιο πρόσφατη)
        $temperature = $data['hourly']['temperature_2m'][0] ?? null;
        $timestamp = $data['hourly']['time'][0] ?? now();
    
        if ($temperature === null) {
            return back()->with('error', 'Δεν βρέθηκαν τιμές θερμοκρασίας');
        }
    
        // Αποθήκευση στη βάση
        $climateData = new ClimateData();
        $climateData->latitude = $latitude;
        $climateData->longitude = $longitude;
        $climateData->temperature = $temperature;
        $climateData->date = $timestamp;
        $climateData->save();
    
        return redirect()->route('climate.view')->with('success', 'Τα δεδομένα αποθηκεύτηκαν!');
    }
    

public function index()
{
    $data = ClimateData::orderBy('date', 'desc')->take(50)->get(); // τα 50 πιο πρόσφατα
    return view('climate.index', compact('data'));
}

    public function getClimateData(Request $request)
    {
        // Δημιουργία client για το API
        $client = new Client();

        // Διεύθυνση API του Open-Meteo (π.χ. για δεδομένα θερμοκρασίας)
        $response = $client->get('https://api.open-meteo.com/v1/forecast', [
            'query' => [
                'latitude' => $request->latitude, // συντεταγμένες που έδωσε ο χρήστης
                'longitude' => $request->longitude,
                'hourly' => 'temperature_2m',
                'start' => $request->start_date,
                'end' => $request->end_date
            ]
        ]);

        // Απόκριση από το API
        $data = json_decode($response->getBody()->getContents(), true);

        // Επιστροφή των δεδομένων
        return response()->json($data);
    }


    public function store(Request $request)
    {
        // Επικύρωση των νέων δεδομένων
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'temperature' => 'required|numeric',
            'humidity' => 'nullable|numeric',
            'wind_speed' => 'nullable|numeric',
            'plant_type' => 'nullable|string',
            'region' => 'nullable|string',
        ]);

        // Δημιουργία νέας καταχώρησης
        ClimateData::create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'date' => now(),
            'temperature' => $request->temperature,
            'humidity' => $request->humidity,
            'wind_speed' => $request->wind_speed,
            'plant_type' => $request->plant_type,
            'region' => $request->region,
        ]);

        return redirect()->back()->with('success', 'Climate data stored successfully!');
    }

    public function destroy($id)
{
    // Find the climate data record by ID
    $entry = ClimateData::findOrFail($id);

    // Delete the record
    $entry->delete();

    // Redirect back with a success message
    return redirect()->route('climate.index')->with('success', 'Data deleted successfully.');
}

    
}

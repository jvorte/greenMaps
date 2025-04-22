<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  // Ensure only authenticated users can access
    }

    // Method to display the index page with surveys and search functionality
    public function index(Request $request)
    {
        $query = Survey::with('user');  // Fetch related user data

        // If search term exists, apply it to the query
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('summit', 'like', "%{$search}%")
                  ->orWhere('plot', 'like', "%{$search}%")
                  ->orWhere('plant_type', 'like', "%{$search}%")
                  ->orWhere('survey_type', 'like', "%{$search}%")
                  ->orWhere('species', 'like', "%{$search}%")
                  ->orWhere('cover', 'like', "%{$search}%");
            });
        }

        $surveys = $query->get();  // Execute the query

        return view('dashboard', compact('surveys'));
    }

    // Show form to create new survey
    public function create()
    {
        return view('Items.create');  // Returns the view for creating items
    }

    // Store new survey data from the form
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'summit' => 'required|string|max:255',
            'plot' => 'required|string|max:255',
            'plant_type' => 'required|string|max:255',
            'survey_type' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'cover' => 'required|string|max:255',
        ]);

        // Create new survey record in database
        Survey::create([
            'summit' => $request->summit,
            'plot' => $request->plot,
            'plant_type' => $request->plant_type,
            'survey_type' => $request->survey_type,
            'species' => $request->species,
            'cover' => $request->cover,
            'user_id' => auth()->id(),  // Link to the authenticated user
        ]);

        return redirect()->route('survey.index')->with('success', 'Survey created successfully');
    }

    // Show form to edit an existing survey
    public function edit($id)
    {
        $survey = Survey::findOrFail($id);  // Find survey by ID
        return view('survey.edit', compact('survey'));
    }

    // Update existing survey data
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'summit' => 'required|string|max:255',
            'plot' => 'required|string|max:255',
            'plant_type' => 'required|string|max:255',
            'survey_type' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'cover' => 'required|string|max:255',
        ]);

        $survey = Survey::findOrFail($id);  // Find survey by ID
        $survey->update($request->all());  // Update survey with request data

        return redirect()->route('survey.index')->with('success', 'Survey updated successfully');
    }

    // Delete survey record
    public function destroy($id)
    {
        $survey = Survey::findOrFail($id);  // Find survey by ID
        $survey->delete();  // Delete survey record

        return redirect()->route('survey.index')->with('success', 'Survey deleted successfully');
    }

    // Method to import CSV data
    public function import(Request $request)
    {
        // Validate CSV file input
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();  // Get the real path of the file
        $data = array_map('str_getcsv', file($path));  // Parse the CSV data

        // Optional: skip header row if present
        array_shift($data);

        // Iterate over each row in the CSV file and create a new survey record
        foreach ($data as $row) {
            Survey::create([
                'summit' => $row[0],
                'plot' => $row[1],
                'plant_type' => $row[2],
                'survey_type' => $row[3],
                'species' => $row[4],
                'cover' => $row[5],
                'user_id' => auth()->id(),  // Link to authenticated user
            ]);
        }

        return redirect()->back()->with('success', 'CSV imported successfully!');
    }
}

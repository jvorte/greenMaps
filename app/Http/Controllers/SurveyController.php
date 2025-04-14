<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  // Διασφαλίζουμε ότι μόνο οι συνδεδεμένοι χρήστες θα έχουν πρόσβαση
    }

    public function index()
    {
        $surveys = Survey::with('user')->get(); 
        return view('dashboard', compact('surveys'));
    }
    

    // Μέθοδος για την αποθήκευση νέας καταχώρησης
    public function create()
    {
        return view('Items.create');  // Θα φορτώσει το resources/views/Items/create.blade.php
    }

    // Αποθήκευση δεδομένων της φόρμας
    public function store(Request $request)
    {
        $request->validate([
            'summit' => 'required|string|max:255',
            'plot' => 'required|string|max:255',
            'plant_type' => 'required|string|max:255',
            'survey_type' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'cover' => 'required|string|max:255',
        ]);

        // Δημιουργία νέου survey
        Survey::create([
            'summit' => $request->summit,
            'plot' => $request->plot,
            'plant_type' => $request->plant_type,
            'survey_type' => $request->survey_type,
            'species' => $request->species,
            'cover' => $request->cover,
            'user_id' => auth()->id(),  // Σύνδεση με τον συνδεδεμένο χρήστη
        ]);

        return redirect()->route('survey.index')->with('success', 'Survey created successfully');
    }

    // Μέθοδος για την επεξεργασία καταχώρησης
    public function edit($id)
    {
        $survey = Survey::findOrFail($id);
        return view('survey.edit', compact('survey'));
    }

    // Μέθοδος για την ενημέρωση καταχώρησης
    public function update(Request $request, $id)
    {
        $request->validate([
            'summit' => 'required|string|max:255',
            'plot' => 'required|string|max:255',
            'plant_type' => 'required|string|max:255',
            'survey_type' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'cover' => 'required|string|max:255',
        ]);

        $survey = Survey::findOrFail($id);
        $survey->update($request->all());

        return redirect()->route('survey.index')->with('success', 'Survey updated successfully');
    }

    // Μέθοδος για τη διαγραφή καταχώρησης
    public function destroy($id)
    {
        $survey = Survey::findOrFail($id);
        $survey->delete();

        return redirect()->route('survey.index')->with('success', 'Survey deleted successfully');
    }
}

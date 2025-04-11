<x-app-layout>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h2>Add New Item</h2>
        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="summit" class="form-label">Summit</label>
                <input type="text" class="form-control" id="summit" name="summit" required>
            </div>
            <div class="mb-3">
                <label for="plot" class="form-label">Plot</label>
                <input type="text" class="form-control" id="plot" name="plot" required>
            </div>
            <div class="mb-3">
                <label for="plantType" class="form-label">Plant Type</label>
                <input type="text" class="form-control" id="plantType" name="plant_type" required>
            </div>
            <div class="mb-3">
                <label for="surveyType" class="form-label">Survey Type</label>
                <input type="text" class="form-control" id="surveyType" name="survey_type" required>
            </div>
            <div class="mb-3">
                <label for="species" class="form-label">Species</label>
                <input type="text" class="form-control" id="species" name="species" required>
            </div>
            <div class="mb-3">
                <label for="cover" class="form-label">Cover</label>
                <input type="text" class="form-control" id="cover" name="cover" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Item</button>
        </form>
    </div>
    @endsection
    

</x-app-layout>
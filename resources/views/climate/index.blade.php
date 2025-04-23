{{-- resources/views/climate/index.blade.php --}}

<x-app-layout>

    @section('content')
    
    <div class="container mt-5">
        <h1 class="mb-2">New+</h1>

        
    
        <!-- Form for fetching climate data -->
        <form method="POST" action="{{ route('climate.fetch') }}">
            @csrf
        
            {{-- Dropdown with predefined regions --}}
            <div class="mb-3">
                <label for="location">Select Region (optional)</label>
                <select id="location" class="form-select" onchange="setCoordinates(this.value)">
                    <option value="">-- Select Region --</option>
                    <option value="47.0707,15.4395">Graz</option>
                    <option value="46.6247,14.3050">Klagenfurt</option>
                    <option value="48.2082,16.3738">Vienna</option>
                    <option value="40.0852,22.3580">Mount Olympus</option>
                </select>
            </div>
        
            {{-- Manual input for latitude and longitude --}}
            <div class="mb-3">
                <label for="latitude">Latitude</label>
                <input type="text" id="latitude" name="latitude" class="form-control" >
            </div>
        
            <div class="mb-3">
                <label for="longitude">Longitude</label>
                <input type="text" id="longitude" name="longitude" class="form-control" >
            </div>
        
            <!-- Button to submit the form and fetch data -->
            <button type="submit" class="btn btn-primary">Fetch Data</button>
        </form>
    
        <div class="container mt-5">
            <h2>Climate Data</h2>
        
            <!-- Table displaying climate data -->
            <table class="table table-bordered mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Temperature (°C)</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Actions</th> <!-- Added Actions column -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $entry)
                        <tr>
                            <td>{{ $entry->date }}</td>
                            <td>{{ $entry->temperature }}</td>
                            <td>{{ $entry->latitude }}</td>
                            <td>{{ $entry->longitude }}</td>
                            <td>
                                <!-- Delete Button -->
                                <form action="{{ route('climate.destroy', $entry->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    
    </div>
    
    <script>
        // Function to automatically fill latitude and longitude based on region selection
        function setCoordinates(value) {
            if (value) {
                const [lat, lon] = value.split(',');
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lon;
            }
        }
    </script>
    
    </x-app-layout>
    
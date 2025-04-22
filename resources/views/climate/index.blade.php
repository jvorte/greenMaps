{{-- resources/views/climate/index.blade.php --}}
<x-app-layout>

@section('content')


<form method="POST" action="{{ route('climate.fetch') }}">
    @csrf

    {{-- Dropdown με έτοιμες περιοχές --}}
    <div class="mb-3">
        <label for="location">Επιλογή Περιοχής (προαιρετικό)</label>
        <select id="location" class="form-select" onchange="setCoordinates(this.value)">
            <option value="">-- Επιλέξτε Περιοχή --</option>
            <option value="47.0707,15.4395">Graz</option>
            <option value="46.6247,14.3050">Klagenfurt</option>
            <option value="48.2082,16.3738">Vienna</option>
            <option value="40.0852,22.3580">Mount Olympus</option>
        </select>
    </div>

    {{-- Χειροκίνητη εισαγωγή συντεταγμένων --}}
    <div class="mb-3">
        <label for="latitude">Γεωγραφικό Πλάτος (Latitude)</label>
        <input type="text" id="latitude" name="latitude" class="form-control" >
    </div>

    <div class="mb-3">
        <label for="longitude">Γεωγραφικό Μήκος (Longitude)</label>
        <input type="text" id="longitude" name="longitude" class="form-control" >
    </div>

    <button type="submit" class="btn btn-primary">Ανάκτηση Δεδομένων</button>
</form>
<div class="container mt-5">
    <h2>Κλιματικά Δεδομένα</h2>

    <table class="table table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                <th>Ημερομηνία</th>
                <th>Θερμοκρασία (°C)</th>
                <th>Γεωγρ. Πλάτος</th>
                <th>Γεωγρ. Μήκος</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $entry)
                <tr>
                    <td>{{ $entry->date }}</td>
                    <td>{{ $entry->temperature }}</td>
                    <td>{{ $entry->latitude }}</td>
                    <td>{{ $entry->longitude }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Δεν υπάρχουν δεδομένα</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


<script>
    function setCoordinates(value) {
        if (value) {
            const [lat, lon] = value.split(',');
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lon;
        }
    }
</script>
</x-app-layout>

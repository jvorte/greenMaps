
{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Navbar --}}
                    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded-1">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#">GLORIA Dashboard</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('items.create') }}" data-bs-toggle="modal" data-bs-target="#newItemModal">+ New</a>

                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#importCsvModal">📁 Import CSV</a>
                                    </li>
                                    
                                </ul>
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2 rounded-1" type="search" placeholder="Search records..." aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                    </nav>




           


<!-- Το Modal -->
<div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="newItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newItemModalLabel">Create New Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
                    
<!-- Modal για Import CSV -->
<div class="modal fade" id="importCsvModal" tabindex="-1" aria-labelledby="importCsvModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('surveys.import') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="importCsvModalLabel">Import Surveys from CSV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="csv_file" class="form-label">Select CSV File</label>
                    <input type="file" class="form-control" name="csv_file" accept=".csv" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal για την εμφάνιση δεδομένων κορυφής -->
<div class="modal fade" id="summitDataModal" tabindex="-1" aria-labelledby="summitDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="summitDataModalLabel">Summit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="summitDataBody">
                <!-- Δεδομένα της κορυφής θα εμφανιστούν εδώ -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


{{-- Table --}}
<div class="table-responsive">
    <table class="table">

                            <thead class="">
                                <tr>
                                    <th>Id</th>
                                    <th>Summit</th>
                                    <th>Plot</th>  
                                    <th>Plant Type</th>                                                                      
                                    <th>Survey type</th>
                                    <th>Species</th>
                                    <th>Cover</th>
                                    <th>User</th>
                                    <th>Actions</th>   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($surveys as $survey)
                                    <tr>
                                        <td>{{ $survey->id }}</td>
                                        <td>
                                            <a href="#" class="summit-link" data-summit="{{ $survey->summit }}">{{ $survey->summit }}</a>
                                        </td>
                                        
                                        
                                        
                                        <td>{{ $survey->plot }}</td>
                                        <td>{{ $survey->plant_type }}</td>
                                        <td>{{ $survey->survey_type }}</td>
                                        <td>{{ $survey->species }}</td>
                                        <td>{{ $survey->cover }}</td>
                                        <td>{{ $survey->user->name }}</td> <!-- Εμφάνιση του χρήστη που έκανε την καταχώρηση -->
                                        <td>
                                            <a href="{{ route('survey.show', $survey->id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="View">View</a>
                                            <a href="{{ route('survey.edit', $survey->id) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">Edit</a>
                                            <form action="{{ route('survey.destroy', $survey->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>





                </div>
            </div>
        </div>
    </div>

    {{-- Add Bootstrap Tooltip Initialization --}}
    @push('scripts')
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    @endpush

<script>
   document.querySelectorAll('.summit-link').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const summitName = this.getAttribute('data-summit');

        // Κλήση στο API για να πάρουμε τα δεδομένα του summit
        fetch(`/api/summit/${summitName}`)
            .then(response => response.json())
            .then(data => {
                // Γεμίζουμε το modal με τα δεδομένα
                const summitDataBody = document.getElementById('summitDataBody');
                summitDataBody.innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;  // Εμφάνιση των δεδομένων σε JSON format
                
                // Εμφανίζουμε το modal
                new bootstrap.Modal(document.getElementById('summitDataModal')).show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Σφάλμα στην ανάκτηση των δεδομένων.");
            });
    });
});

</script>



</x-app-layout>

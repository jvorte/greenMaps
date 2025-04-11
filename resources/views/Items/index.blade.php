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
                                        <a class="nav-link" href="{{ route('items.create') }}">+ New</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
    
                    {{-- Table --}}
                    <div class="mt-4">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Summit</th>
                                    <th>Plot</th>
                                    <th>Plant Type</th>
                                    <th>Survey Type</th>
                                    <th>Species</th>
                                    <th>Cover</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->summit }}</td>
                                    <td>{{ $item->plot }}</td>
                                    <td>{{ $item->plant_type }}</td>
                                    <td>{{ $item->survey_type }}</td>
                                    <td>{{ $item->species }}</td>
                                    <td>{{ $item->cover }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="View">View</a>
                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete">Delete</a>
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

</x-app-layout>

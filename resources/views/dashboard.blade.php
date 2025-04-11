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
                                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#newItemModal">+ New</a>
                                    </li>
                                    
                                 
                                </ul>
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2 rounded-1" type="search" placeholder="Search records..." aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                    </nav>

                    {{-- Table --}}
                    <div class="mt-4 ">
                   
                        <table class="table table-bordered table-hover ">
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
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="View">View</a>
                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete">Delete</a>
                                    </td>
                                </tr>
                        
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

</x-app-layout>


<x-app-layout>

@section('content')
    <h1>Data Sources</h1>
    <a href="{{ route('data_sources.create') }}">Add New Source</a>
    <ul>
        @foreach($dataSources as $dataSource)
            <li>{{ $dataSource->name }} ({{ $dataSource->type }})</li>
        @endforeach
    </ul>
@endsection

</x-app-layout>

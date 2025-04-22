// resources/views/data_sources/create.blade.php
@extends('layouts.app')

@section('content')
    <h1>Create Data Source</h1>
    <form action="{{ route('data_sources.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="type">Type:</label>
        <input type="text" id="type" name="type" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br><br>

        <button type="submit">Save</button>
    </form>
@endsection

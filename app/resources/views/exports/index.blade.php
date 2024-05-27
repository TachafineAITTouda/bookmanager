@extends('layouts.app')

@section('title', 'Exports')

@section('content')
<h2 class="mb-2 text-lg font-bold text-gray-900 dark:text-gray-300">Export Options</h2>
<form action="{{ route('export.export') }}" method="POST" class="mt-4">
    @csrf
    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-4 text-md font-bold tracking-tight text-gray-900 dark:text-white">Export Fields</h5>
            <div class="flex">
                <div class="flex items-center me-4">
                    <input checked id="all" type="radio" value="all" name="fields" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="all" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">All fields</label>
                </div>
                <div class="flex items-center me-4">
                    <input  id="author" type="radio" value="author" name="fields" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="author" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Author</label>
                </div>
                <div class="flex items-center me-4">
                    <input id="title" type="radio" value="title" name="fields" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="title" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Title</label>
                </div>
            </div>
            <h5 class="mb-4 mt-4 text-sm font-bold tracking-tight text-gray-900 dark:text-white">Export Format</h5>

            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                <input id="xml" type="radio" value="xml" name="format" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="xml" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">XML</label>
            </div>
            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                <input checked id="csv" type="radio" value="csv" name="format" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="csv" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">CSV</label>
            </div>

            <button type="submit" class="mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Export
            </button>
        </div>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $errors->first('fields') }}
            {{ $errors->first('format') }}
        </p>
    </div>
</form>
@endsection

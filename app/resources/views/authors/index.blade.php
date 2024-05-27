@extends('layouts.app')
@section('title', 'Books')

@section('content')

<div class="relative overflow-x-auto mb-16">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Author
                </th>
                <th scope="col" class="px-6 py-3">
                    Books Count
                </th>
                <th scope="col" class="px-6 py-3">
                    Author Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
            <tr class="bg-white dark:bg-gray-800">
                <td class="px-6 py-4">
                    {{ $author->fullname }}

                </td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                        {{ $author->books->count() }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('authors.edit', $author->id) }}" class="text-blue-700 hover:underline dark:text-blue-400">Edit</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
{{ $authors->links() }}
@endsection

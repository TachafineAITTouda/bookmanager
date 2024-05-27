@extends('layouts.app')
@section('title', 'Books')

@section('content')

@include('books.form')
<div class="relative overflow-x-auto mb-16">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col-6" class="px-6 py-3">
                    Book Title
                </th>
                <th scope="col-4" class="px-6 py-3">
                    Author
                </th>
                <th scope="col-2" class="px-6 py-3">
                    Book Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr class="bg-white dark:bg-gray-800">
                <td class="px-6 py-4">
                    {{ $book->title }}
                </td>
                <td class="px-6 py-4">
                    {{ $book->author->fullname }}
                    <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                        {{ $book->author->books->count() }}
                    </span>
                    <a href="" class="text-blue-500 hover:text-blue-700">Edit</a>
                </td>
                <td class="px-6 py-4 text-sm">
                    <a
                    href="{{ route('books.edit', $book->id) }}"
                    class="text-blue-500 hover:text-blue-700 ms-2">
                        Edit
                    </a>
                    <form class="inline" action="{{ route('books.destroy', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 ms-2">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
{{ $books->links() }}
@endsection

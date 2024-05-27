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
            <tr class="bg-white dark:bg-gray-800">
                <td class="px-6 py-4">
                    <form class="max-w-md mx-auto" action="{{ route('books.index') }}" method="GET">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input
                            name="stitle"
                            type="search"
                            id="default-search"
                            value="{{ request()->stitle }}"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by book title" required />
                            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">find</button>
                        </div>
                    </form>
                </td>
                <td class="px-6 py-4">
                    <form class="max-w-md mx-auto" action="{{ route('books.index') }}" method="GET">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input
                            name="sauthorname"
                            type="search"
                            id="default-search"
                            value="{{ request()->sauthorname }}"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by book title" required />
                            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">find</button>
                        </div>
                    </form>
                </td>
                <td class="px-6 py-4 text-sm">

                </td>
            </tr>
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

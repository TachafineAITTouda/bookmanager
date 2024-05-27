@extends('layouts.app')
@section('title', 'Books')

@section('content')
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
                    Actions
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
                </td>
                <td class="px-6 py-4 text-sm">
                    Actions
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
{{ $books->links() }}
@endsection

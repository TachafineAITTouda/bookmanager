<form class="max-w-sm mb-3 mx-auto"
@isset($book)
    action="{{ route('books.update', $book->id) }}"
@else
    action="{{ route('books.store') }}"
@endisset
method="POST">
    @csrf
    @isset($book)
        @method('PUT')
    @endisset
    <div class="mb-5">
        <label for="title" class="block mb-1 text-sm font-medium text-gray-900">Book name</label>
        <input
        type="text"
        name="title"
        id="title"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Book name"
        @if(!empty($book)) value="{{ $book->title }}" @endif
        required />
        <p class="text-xs text-red-500 mt-1"> {{ $errors->first('title') }} </p>
    </div>
    <div class="mb-5">
        <label for="authorname" class="block mb-1 text-sm font-medium text-gray-900">Author Name</label>
        <input
        type="text"
        name="authorname"
        id="authorname"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        required
        @if(!empty($book)) value="{{ $book->author->fullname }}" @endif
        placeholder="Author name"/>
        <p class="text-xs text-red-500 mt-1"> {{ $errors->first('authorname') }} </p>
    </div>
    @if(session('error'))
        <p class="text-red-500 mt-1 text-sm text-center"> {{ session('error') }} </p>
    @endif
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        @if(!empty($book)) Update Book @else Add new Book @endif
    </button>
</form>

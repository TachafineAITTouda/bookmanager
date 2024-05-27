<form class="max-w-sm mb-3 mx-auto" action="{{ route('authors.update', $author->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-5">
        <label for="fullname" class="block mb-1 text-sm font-medium text-gray-900">Author Name</label>
        <input
        type="text"
        name="fullname"
        id="fullname"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        required
        @if(!empty($author)) value="{{ $author->fullname }}" @endif
        placeholder="Author name"/>
        <p class="text-xs text-red-500 mt-1"> {{ $errors->first('fullname') }} </p>
    </div>
    @if(session('error'))
        <p class="text-red-500 mt-1 text-sm text-center"> {{ session('error') }} </p>
    @endif
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Update Author
    </button>
</form>

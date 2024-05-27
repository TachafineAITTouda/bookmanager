<form method="GET" action="{{ route('books.index') }}" class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Filter books</h5>
    <div class="flex flex-col space-y-4">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input name="stitle" type="search" id="default-search" value="{{ request()->stitle }}" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by book title" />
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">find</button>
        </div>
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input name="sauthorname" type="search" id="default-search" value="{{ request()->sauthorname }}" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by Author name" />
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">find</button>
        </div>
        <div class="flex items-center">
            <label class="block text-sm font-medium text-gray-700 mr-2">Sort by:</label>
            <div class="flex items-center">
                <input type="radio" id="sort-title" name="sort" value="title" class="form-radio" {{ request('sort') == 'title' ? 'checked' : '' }}>
                <label for="sort-title" class="ml-1 text-sm text-gray-700">Title</label>
            </div>
            <div class="flex items-center ml-4">
                <input type="radio" id="sort-author" name="sort" value="author" class="form-radio" {{ request('sort') == 'author' ? 'checked' : '' }}>
                <label for="sort-author" class="ml-1 text-sm text-gray-700">Author</label>
            </div>
        </div>

        <!-- Sort Direction Radio Buttons -->
        <div class="flex items-center">
            <label class="block text-sm font-medium text-gray-700 mr-2">Direction:</label>
            <div class="flex items-center">
                <input type="radio" id="direction-asc" name="direction" value="asc" class="form-radio" {{ request('direction') == 'asc' ? 'checked' : '' }}>
                <label for="direction-asc" class="ml-1 text-sm text-gray-700">Asc</label>
            </div>
            <div class="flex items-center ml-4">
                <input type="radio" id="direction-desc" name="direction" value="desc" class="form-radio" {{ request('direction') == 'desc' ? 'checked' : '' }}>
                <label for="direction-desc" class="ml-1 text-sm text-gray-700">Desc</label>
            </div>
        </div>

        <div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-small rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Sort
            </button>
            <a href="{{ route('books.index') }}" class="text-red-700 hover:underline focus:ring-4 focus:outline-none focus:ring-red-300 font-small rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:text-red-300 dark:hover:text-red-400 dark:focus:ring-red-800">
                Reset
            </a>
        </div>

        @foreach(request()->except('page', 'sort', 'direction') as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </div>
</form>

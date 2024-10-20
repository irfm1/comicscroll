<div class="p-4 bg-white dark:bg-gray-800 rounded shadow-md w-11/12 mx-auto">
    <form action="{{ route('getComic') }}" method="POST" class="space-y-4 flex items-center">
        @csrf
        <div class="flex-grow flex items-center">

            <input type="text" name="url" id="url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white" placeholder="Enter URL of comic">
        </div>
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <div class="ml-4 w-3/12">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Get Comic</button>
        </div>
    </form>
</div>


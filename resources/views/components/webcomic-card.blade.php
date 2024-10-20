<div class="bg-white dark:bg-gray-800 p-4 m-1 rounded shadow">
    <a href="{{ route('showComic', ['comic' => $comic]) }}">
        <img src="{{ $image }}" alt="{{ $title }}" class="rounded-lg" style="height: 435px; object-fit: cover; width: 100%;">
    </a>
    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $title }}</h2>
    <p class="mt-2 text-gray-500 dark:text-gray-400">{{ $description }}</p>
</div>



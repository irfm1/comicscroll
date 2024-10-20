<div class="font-sans antialiased dark:bg-blue-950 dark:text-white/50 min-h-screen flex flex-col sm:mt-1">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-6 mt-2">ComicScroll</h1>
        @if (Route::has('login'))
            <div class="flex justify-center space-x-4 mb-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-lg text-gray-700 dark:text-gray-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-lg text-gray-700 dark:text-gray-300">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-lg text-gray-700 dark:text-gray-300">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div class="w-full">
    <div>
    <x-get-comic-card />

    <!-- List of webcomic cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 mt-5">
        @foreach ($comics as $comic)

            <x-webcomic-card :title="$comic->title" :image="$comic->image" :description="$comic->genre" :comic="$comic" />
        @endforeach
    </div>
</div>

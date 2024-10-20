<div>

{{--        Area de tratamento de erros com um emit flashMessage--}}
    <div>

    </div>



    <div class="flex justify-between items-center mb-4">
        <button wire:click="fetchChapters()" wire:loading.attr="disabled" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <span wire:loading.remove>Buscar Capítulos</span>
            <span wire:loading>Buscando...</span>
        </button>
    </div>

    <ul class="space-y-2">
        @foreach($chapters as $chapter)
            <li>
                <a href="{{ route('showChapter', ['comic' => $comic, 'chapter' => $chapter]) }}" class="text-blue-600 hover:underline">
                    {{ $chapter->title }}
                </a>
            </li>
        @endforeach
</div>





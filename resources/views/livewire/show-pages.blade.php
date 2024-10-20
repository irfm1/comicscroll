<div>
    <div class="flex items-center justify-between mb-4">
        <button wire:click="fetchPages()" wire:loading.attr="disabled" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <span wire:loading.remove>Buscar Paginas</span>
            <span wire:loading>Buscando...</span>
        </button>
    </div>
    <div class="flex items-center justify-between mb-4">
        <button wire:click="savePages()" wire:loading.attr="disabled" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <span wire:loading.remove>Salvar Paginas</span>
            <span wire:loading>Salvando...</span>
        </button>
    </div>


        @foreach($pages as $page)
            @foreach($page->getMedia('pages') as $media)
                <img src="{{ $media->getUrl() }}" alt="{{ $page->title }}">

            @endforeach

        @endforeach


</div>

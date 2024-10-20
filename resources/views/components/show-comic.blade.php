<div class="py-12 px-4">


    <div class="flex space-x-4">
        <!-- Lado esquerdo: Dados do comic (30%) -->
        <div class="w-4/12">
            <div class="card shadow-md rounded-lg overflow-hidden text-zinc-100" style="background: #380000;">
                <img src="{{ $comic->image }}" class="w-full h-70 object-cover" alt="{{ $comic->title }}">
                <div class="p-4">
                    <h5 class="text-lg font-bold text-center mb-2">{{ $comic->title }}</h5>
                    <a href="{{ $comic->url }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">Go to comic</a>
                </div>
            </div>
        </div>

        <!-- Lado direito: Descrição e lista de capítulos (70%) -->
        <div class="w-8/12">
            <div class="card shadow-md rounded-lg overflow-hidden text-zinc-100" style="background: #380000;" >
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-4">Descrição</h2>
                    <p class=" mb-6">{{ $comic->description }}</p>

                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Capítulos</h2>
                        <livewire:comic-chapters :comic="$comic" />
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

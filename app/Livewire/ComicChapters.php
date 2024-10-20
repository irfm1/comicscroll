<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comic;
use App\Services\ComicScraperService;
use Exception;

use Livewire\Attributes\On;

class ComicChapters extends Component
{
    public $comic;
    public $chapters = [];
    public $isLoading = false;

    protected $listeners = ['refreshChapters' => '$refresh'];

    public function mount(Comic $comic)
    {
        $this->comic = $comic;
        $this->loadChapters();
    }

    public function render()
    {
        return view('livewire.comic-chapters');
    }

    public function loadChapters()
    {
        $this->chapters = $this->comic->chapters()->orderBy('id')->get();
    }

    public function fetchChapters()
    {
        $this->isLoading = true;

        try {
            $scraper = app(ComicScraperService::class);
            $newChapters = $scraper->scrapeChapters($this->comic->url);

            //inverter a ordem dos capitulos
            $newChapters = array_reverse($newChapters);
            // Atualiza os capítulos no banco de dados
            foreach ($newChapters as $chapterData) {
                $this->comic->chapters()->updateOrCreate(
                    ['number' => $chapterData['number']],
                    ['title' => $chapterData['title'], 'url' => $chapterData['url']]
                );
            }

            $this->loadChapters();
            $this->dispatch('chaptersUpdated');
            $this->dispatch('flashMessage', ['type' =>'success','message' => 'Mensagem']);



        } catch (Exception $e) {
            $this->dispatch('flashMessage', ['type' => 'error', 'message' => $e->getMessage()]);

        }

        $this->isLoading = false;
    }
}

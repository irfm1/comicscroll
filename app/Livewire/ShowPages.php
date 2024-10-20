<?php

namespace App\Livewire;

use App\Models\Chapter;
use App\Models\Comic;
use App\Services\ComicScraperService;
use Exception;
use Livewire\Component;

class ShowPages extends Component
{
    public $comic;
    public $chapter;

    public $pages = [];
    public $isLoading = false;

    protected $listeners = ['refreshPages' => '$refresh'];

    public function mount(Comic $comic, Chapter $chapter)
    {
        $this->comic = $comic;
        $this->chapter = $chapter;
        $this->loadPages();
    }
    public function render()
    {
        return view('livewire.show-pages');
    }

    public function loadPages()
    {
        $this->pages = $this->chapter->pages()->orderBy('number')->get();
    }

    public function fetchPages()
    {
        $this->isLoading = true;
        try {
            $scraper = app(ComicScraperService::class);

            $newPages = $scraper->scrapePages($this->chapter->url);
            foreach ($newPages as $pageData) {
                $this->chapter->pages()->updateOrCreate(
                    ['number' => $pageData['number']],
                    ['image' => $pageData['image']]
                );


            }
            $this->loadPages();

            $this->dispatch('pagesUpdated');
        }
        catch (Exception $e) {
            $this->dispatch('flashMessage', ['type' => 'error', 'message' => $e->getMessage()]);
        }
        $this->isLoading = false;

    }

    public function savePages()
    {
        $this->isLoading = true;
        foreach ($this->pages as $page) {
            $page->image = str_replace("\n", '', $page->image);
            //check if image is already in media collection
            if($page->getFirstMedia('pages') == null)
                $page->addMediaFromUrl($page->image)->toMediaCollection('pages');
        }
        $this->isLoading = false;
    }


}

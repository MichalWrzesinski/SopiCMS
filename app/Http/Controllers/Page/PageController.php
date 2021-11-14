<?php

declare(strict_types=1);

namespace App\Http\Controllers\Page;

use Illuminate\View\View;
use App\Repository\Eloquent\PageRepository;
use App\Repository\Eloquent\GalleryRepository;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    private PageRepository $pageRepository;

    public function __construct(PageRepository $pageRepository, GalleryRepository $galleryRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->galleryRepository = $galleryRepository;
    }

    public function show(string $url): View
    {
        $page = $this->pageRepository->getByUrl($url);

        return View('main.pages.default', [
            'page' => $page,
            'gallery' => $this->galleryRepository->list('pages', $page->id)->toArray(),
        ]);
    }
}

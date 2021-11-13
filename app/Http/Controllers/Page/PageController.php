<?php

declare(strict_types=1);

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\PageRepository;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    private PageRepository $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function show(string $url): View
    {
        return View('main.pages.default', [
            'page' => $this->pageRepository->getByUrl($url),
        ]);
    }
}

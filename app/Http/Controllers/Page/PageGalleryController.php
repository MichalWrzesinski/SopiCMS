<?php

declare(strict_types=1);

namespace App\Http\Controllers\Page;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;
use App\Repository\Eloquent\PageRepository;
use App\Http\Controllers\Controller;

class PageGalleryController extends Controller
{
    private PageRepository $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function addSend(ImageRequest $request, int $id)
    {
        $file = $request->file('image')->store('pages', 'public');
        $this->pageRepository->imageAdd($id, $file);
        return back()->with('success', 'Zdjęcie zostało dodane do galerii');
    }

    public function deleteSend(Request $request, int $id, int $key)
    {
        $this->pageRepository->imageDelete($id, $key);
        return back()->with('success', 'Zdjęcie zostało usunięte z galerii');
    }

    public function coverSend(Request $request, int $id, int $key)
    {
        $this->pageRepository->imageCover($id, $key);
        return back()->with('success', 'Zdjęcie zostało umstawione jako główne');
    }
}

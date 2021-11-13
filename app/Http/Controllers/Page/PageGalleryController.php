<?php

declare(strict_types=1);

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Repository\PageRepository;
use App\Http\Controllers\Controller;

class PageGalleryController extends Controller
{
    private PageRepository $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function addSend(Request $request, int $id)
    {
        $request->validate([
            'file' => ['required', 'file', 'image', 'mimes:jpg,jpeg,gif,png,bmp', 'max:10240'],
        ]);

        $file = $request->file('file')->store('pages', 'public');
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

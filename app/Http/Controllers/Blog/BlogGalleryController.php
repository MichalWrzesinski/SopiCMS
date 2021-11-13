<?php

declare(strict_types=1);

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\BlogRepository;
use App\Http\Controllers\Controller;

class BlogGalleryController extends Controller
{
    private BlogRepository $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function addSend(Request $request, int $id)
    {
        $request->validate([
            'file' => ['required', 'file', 'image', 'mimes:jpg,jpeg,gif,png,bmp', 'max:10240'],
        ]);

        $file = $request->file('file')->store('blog', 'public');
        $this->blogRepository->imageAdd($id, $file);

        return back()->with('success', 'Zdjęcie zostało dodane do galerii');
    }

    public function deleteSend(Request $request, int $id, int $key)
    {
        $this->blogRepository->imageDelete($id, $key);

        return back()->with('success', 'Zdjęcie zostało usunięte z galerii');
    }

    public function coverSend(Request $request, int $id, int $key)
    {
        $this->blogRepository->imageCover($id, $key);

        return back()->with('success', 'Zdjęcie zostało umstawione jako główne');
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\Eloquent\BlogRepository;
use App\Repository\Eloquent\GalleryRepository;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    private BlogRepository $blogRepository;
    private GalleryRepository $galleryRepository;

    public function __construct(BlogRepository $blogRepository, GalleryRepository $galleryRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->galleryRepository = $galleryRepository;
    }

    public function list(Request $request): View
    {
        $list = $this->blogRepository->list($request, config('sopicms.paginate'));

        return View('main.blogs.list', [
            'title' => 'Blog',
            'list' => $list,
            'gallery' => $this->galleryRepository->coverList('blogs', $list->pluck('id')->toArray()),
        ]);
    }

    public function show(int $id, string $url): View
    {
        return View('main.blogs.show', [
            'blog' => $this->blogRepository->get($id),
            'gallery' => $this->galleryRepository->list('blogs', $id)->toArray(),
        ]);
    }
}

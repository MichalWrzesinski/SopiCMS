<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\BlogRepository;
use App\Repository\Eloquent\ItemRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\GalleryRepository;
use Illuminate\View\View;

class HomeController extends Controller
{
    private ItemRepository $itemRepository;
    private CategoryRepository $categoryRepository;
    private BlogRepository $blogRepository;
    private GalleryRepository $galleryRepository;

    public function __construct(ItemRepository $itemRepository, CategoryRepository $categoryRepository, BlogRepository $blogRepository, GalleryRepository $galleryRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->categoryRepository = $categoryRepository;
        $this->blogRepository = $blogRepository;
        $this->galleryRepository = $galleryRepository;
    }

    public function index(): View
    {
        $blog = $this->blogRepository->list([], 5, 'created_at', 'DESC');
        $new = $this->itemRepository->list([], 4, 'created_at', 'DESC');
        $premium = $this->itemRepository->list([], 4, 'premium', 'DESC');

        $gallery = [
            'blog' => $this->galleryRepository->coverList('items', $blog->pluck('id')->toArray()),
            'new' => $this->galleryRepository->coverList('items', $new->pluck('id')->toArray()),
            'premium' => $this->galleryRepository->coverList('items', $premium->pluck('id')->toArray()),
        ];

        return View('main.layouts.index', [
            'title' => config('sopicms.title'),
            'blog' => $blog,
            'new' => $new,
            'premium' => $premium,
            'category' => $this->categoryRepository->parentList(),
            'gallery' => $gallery,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Repository\BlogRepository;
use App\Repository\ItemRepository;
use App\Repository\CategoryRepository;
use Illuminate\View\View;

class HomeController extends Controller
{
    private ItemRepository $itemRepository;
    private CategoryRepository $categoryRepository;
    private BlogRepository $blogRepository;

    public function __construct(ItemRepository $itemRepository, CategoryRepository $categoryRepository, BlogRepository $blogRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->categoryRepository = $categoryRepository;
        $this->blogRepository = $blogRepository;
    }

    public function index(): View
    {
        return View('main.layouts.index', [
            'title' => config('sopicms.title'),
            'blog' => $this->blogRepository->list([], 5, 'created_at', 'DESC'),
            'new' => $this->itemRepository->list([], 4, 'created_at', 'DESC'),
            'premium' => $this->itemRepository->list([], 4, 'premium', 'DESC'),
            'category' => $this->categoryRepository->parentList(),
        ]);
    }
}

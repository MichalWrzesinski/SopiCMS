<?php

declare(strict_types=1);

namespace App\Http\Controllers\Blog;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\Eloquent\BlogRepository;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    private BlogRepository $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function list(Request $request): View
    {
        return View('main.blogs.list', [
            'title' => 'Blog',
            'list' => $this->blogRepository->list($request, config('sopicms.paginate')),
        ]);
    }

    public function show(int $id, string $url): View
    {
        return View('main.blogs.show', [
            'blog' => $this->blogRepository->get($id),
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Blog;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\Eloquent\BlogRepository;
use App\Http\Controllers\Controller;

class BlogAdminController extends Controller
{
    private BlogRepository $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function list(Request $request): View
    {
        return View('admin.blogs.list', [
            'title' => 'Strony',
            'list' => $this->blogRepository->list($request, config('sopicms.paginate')),
        ]);
    }

    public function addSend(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
        ]);

        $id = $this->blogRepository->add($request);

        return redirect()->route('admin.blog.edit', ['id' => $id]);
    }

    public function edit(Int $id): View
    {
        return View('admin.blogs.edit', [
            'id' => $id,
            'title' => 'Edycja wpisu',
            'blog' => $this->blogRepository->get($id),
        ]);
    }

    public function editSend(Request $request, int $id)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
        ]);

        $this->blogRepository->update($id, $request);

        return back()->with('success', 'Zmiany zostały zapisane');
    }

    public function deleteSend(Request $request, int $id)
    {
        $request->validate([
            'delete' => ['required'],
        ]);

        $this->blogRepository->delete($id);

        return redirect()->route('admin.blog.list')
            ->with('success', 'Wpis został usunięty');
    }
}

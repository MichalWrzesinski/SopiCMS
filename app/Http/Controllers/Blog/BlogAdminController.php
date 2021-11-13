<?php

declare(strict_types=1);

namespace App\Http\Controllers\Blog;

use App\Http\Requests\DeleteRequest;
use App\Http\Requests\TitleRequest;
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

    public function addSend(TitleRequest $request)
    {
        return redirect()->route('admin.blog.edit', ['id' => $this->blogRepository->add($request)]);
    }

    public function edit(Int $id): View
    {
        return View('admin.blogs.edit', [
            'id' => $id,
            'title' => 'Edycja wpisu',
            'blog' => $this->blogRepository->get($id),
        ]);
    }

    public function editSend(TitleRequest $request, int $id)
    {
        $this->blogRepository->update($id, $request);
        return back()->with('success', 'Zmiany zostały zapisane');
    }

    public function deleteSend(DeleteRequest $request, int $id)
    {
        $this->blogRepository->delete($id);

        return redirect()->route('admin.blog.list')
            ->with('success', 'Wpis został usunięty');
    }
}

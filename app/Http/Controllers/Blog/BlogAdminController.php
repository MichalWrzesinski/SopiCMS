<?php

declare(strict_types=1);

namespace App\Http\Controllers\Blog;

use App\Http\Requests\DeleteRequest;
use App\Http\Requests\TitleRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\Eloquent\BlogRepository;
use App\Repository\Eloquent\GalleryRepository;
use App\Http\Controllers\Controller;

class BlogAdminController extends Controller
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
        return View('admin.blogs.list', [
            'title' => __('blog.header.title'),
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
            'title' => __('blog.header.edit'),
            'blog' => $this->blogRepository->get($id),
            'gallery' => $this->galleryRepository->list('blogs', $id)->toArray(),
        ]);
    }

    public function editSend(TitleRequest $request, int $id)
    {
        $this->blogRepository->update($id, $request);
        return back()->with('success', __('layout.alert.save'));
    }

    public function deleteSend(DeleteRequest $request, int $id)
    {
        $this->blogRepository->delete($id);

        return redirect()->route('admin.blog.list')
            ->with('success', __('blog.alert.deleted'));
    }
}

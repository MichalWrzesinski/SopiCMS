<?php

declare(strict_types=1);

namespace App\Http\Controllers\Page;

use App\Http\Requests\DeleteRequest;
use App\Http\Requests\TitleRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\Eloquent\PageRepository;
use App\Repository\Eloquent\GalleryRepository;
use App\Http\Controllers\Controller;

class PageAdminController extends Controller
{
    private PageRepository $pageRepository;
    private GalleryRepository $galleryRepository;

    public function __construct(PageRepository $pageRepository, GalleryRepository $galleryRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->galleryRepository = $galleryRepository;
    }

    public function list(Request $request): View
    {
        return View('admin.pages.list', [
            'title' => __('pages.header.title'),
            'list' => $this->pageRepository->list($request, config('sopicms.paginate')),
        ]);
    }

    public function addSend(TitleRequest $request)
    {
        return redirect()->route('admin.pages.edit', ['id' => $this->pageRepository->add($request)]);
    }

    public function edit(int $id): View
    {
        return View('admin.pages.edit', [
            'id' => $id,
            'title' => __('pages.header.edit'),
            'page' => $this->pageRepository->get($id),
            'gallery' => $this->galleryRepository->list('pages', $id)->toArray(),
        ]);
    }

    public function editSend(Request $request, int $id)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'url' => ['required', 'max:255', 'unique:pages,url,'.$id],
        ]);

        $this->pageRepository->update($id, $request);

        return back()->with('success', __('layout.alert.save'));
    }

    public function deleteSend(DeleteRequest $request, int $id)
    {
        $this->pageRepository->delete($id);
        return redirect()->route('admin.pages.list')
            ->with('success', __('pages.alert.deleted'));
    }
}

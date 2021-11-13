<?php

declare(strict_types=1);

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\Eloquent\PageRepository;
use App\Http\Controllers\Controller;

class PageAdminController extends Controller
{
    private PageRepository $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function list(Request $request): View
    {
        return View('admin.pages.list', [
            'title' => 'Strony',
            'list' => $this->pageRepository->list($request, config('sopicms.paginate')),
        ]);
    }

    public function addSend(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
        ]);

        $id = $this->pageRepository->add($request);

        return redirect()->route('admin.pages.edit', ['id' => $id]);
    }

    public function edit(int $id): View
    {
        return View('admin.pages.edit', [
            'id' => $id,
            'title' => 'Edycja strony',
            'page' => $this->pageRepository->get($id),
        ]);
    }

    public function editSend(Request $request, int $id)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'url' => ['required', 'max:255', 'unique:pages,url,'.$id],
        ]);

        $this->pageRepository->update($id, $request);

        return back()->with('success', 'Zmiany zostały zapisane');
    }

    public function deleteSend(Request $request, int $id)
    {
        $request->validate([
            'delete' => ['required'],
        ]);

        $this->pageRepository->delete($id);

        return redirect()->route('admin.pages.list')
            ->with('success', 'Strona została usunięta');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NameRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\Eloquent\CategoryRepository;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function list(): View
    {
        return View('admin.categories.list', [
            'title' => __('categories.header.title'),
            'list' => $this->categoryRepository->list(),
        ]);
    }

    public function addSend(NameRequest $request)
    {
        $this->categoryRepository->add($request);
        return back()->with('success', __('categories.alert.add'));
    }

    public function up(int $id)
    {
        if(!$this->categoryRepository->up($id)) {
            return back()->with('error', __('categories.alert.errorUp'));
        }

        return back()->with('success', __('categories.alert.doneUp'));
    }

    public function down(int $id)
    {
        if(!$this->categoryRepository->down($id)) {
            return back()->with('error', __('categories.alert.errorDown'));
        }

        return back()->with('success', __('categories.alert.doneDown'));
    }

    public function edit(int $id): View
    {
        return View('admin.categories.edit', [
            'id' => $id,
            'title' => __('categories.header.edit'),
            'category' => $this->categoryRepository->get($id),
            'list' => $this->categoryRepository->list(),
        ]);
    }

    public function editSend(NameRequest $request, int $id)
    {
        $this->categoryRepository->update($id, $request);
        return back()->with('success', __('layout.alert.save'));
    }

    public function deleteSend(Request $request, int $id)
    {
        $this->categoryRepository->delete($id);

        return redirect()->route('admin.categories.list')
            ->with('success', __('categories.alert.delete'));
    }
}

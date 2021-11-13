<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\CategoryRepository;
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
            'title' => 'Kategorie',
            'list' => $this->categoryRepository->list(),
        ]);
    }

    public function addSend(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $this->categoryRepository->add($request);

        return back()->with('success', 'Kategoria została dodana');
    }

    public function up(int $id)
    {
        if(!$this->categoryRepository->up($id)) {
            return back()->with('error', 'Nie można przesunąć kategorii w górę');
        }

        return back()->with('success', 'Kategoria została przesunięta w górę');
    }

    public function down(int $id)
    {
        if(!$this->categoryRepository->down($id)) {
            return back()->with('error', 'Nie można przesunąć kategorii w dół');
        }

        return back()->with('success', 'Kategoria została przesunięta w dół');
    }

    public function edit(int $id): View
    {
        return View('admin.categories.edit', [
            'id' => $id,
            'title' => 'Edycja kategorii',
            'category' => $this->categoryRepository->get($id),
            'list' => $this->categoryRepository->list(),
        ]);
    }

    public function editSend(Request $request, int $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $this->categoryRepository->update($id, $request);

        return back()->with('success', 'Zmiany zostały zapisane');
    }

    public function deleteSend(Request $request, int $id)
    {
        $this->categoryRepository->delete($id);

        return redirect()->route('admin.categories.list')
            ->with('success', 'Kategoria została usunięta');
    }
}

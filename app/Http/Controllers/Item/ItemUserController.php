<?php

declare(strict_types=1);

namespace App\Http\Controllers\Item;

use App\Http\Requests\DeleteRequest;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Repository\Eloquent\ItemRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\UserRepository;
use App\Http\Controllers\Controller;

class ItemUserController extends Controller
{
    private ItemRepository $itemRepository;
    private CategoryRepository $categoryRepository;
    private UserRepository $userRepository;

    public function __construct(ItemRepository $itemRepository, CategoryRepository $categoryRepository, UserRepository $userRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
    }

    public function list(): View
    {
        return View('main.items.user.list', [
            'title' => config('sopicms.item.userList'),
            'list' => $this->itemRepository->userItems(Auth::id(), config('sopicms.paginate')),
        ]);
    }

    public function add(): View
    {
        return View('main.items.user.add', [
            'title' => config('sopicms.item.add'),
            'list' => $this->categoryRepository->list(),
        ]);
    }

    public function addSend(ItemRequest $request)
    {
        return redirect()->route('user.item.edit', ['id' => $this->itemRepository->add($request)])
            ->with('success', 'Ogłoszenie zostało dodane. Zaczekaj na aktywację przez administratora.');
    }

    public function edit(int $id): View
    {
        return View('main.items.user.edit', [
            'title' => config('sopicms.item.edit'),
            'id' => $id,
            'item' => $this->itemRepository->get($id, Auth::id()),
            'list' => $this->categoryRepository->list(),
        ]);
    }

    public function editSend(ItemRequest $request, int $id)
    {
        $this->itemRepository->update($id, $request, Auth::id());
        return back()->with('success', 'Zmiany zostały zapisane.');
    }

    public function deleteSend(DeleteRequest $request, int $id)
    {
        $this->itemRepository->delete($id, Auth::id());

        return redirect()->route('user.item.list')
            ->with('success', 'Ogłoszenie zostało usunięte');
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Repository\ItemRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
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

    public function addSend(Request $request)
    {
        $request['price'] = convertToNumber($request['price']);

        $request->validate([
            'title' => ['required', 'min:10'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'integer'],
            'region' => ['required', 'integer'],
            'city' => ['required', 'min:5'],
            'content' => ['required', 'min:50'],
        ]);

        $id = $this->itemRepository->add($request);

        return redirect()->route('user.item.edit', ['id' => $id])
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

    public function editSend(Request $request, int $id)
    {
        $request->validate([
            'title' => ['required', 'min:10'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'integer'],
            'region' => ['required', 'integer'],
            'city' => ['required', 'min:5'],
            'content' => ['required', 'min:100'],
        ]);

        $this->itemRepository->update($id, $request, Auth::id());

        return back()->with('success', 'Zmiany zostały zapisane.');
    }

    public function deleteSend(Request $request, int $id)
    {
        $this->itemRepository->delete($id, Auth::id());

        return redirect()->route('user.item.list')
            ->with('success', 'Ogłoszenie zostało usunięte');
    }
}

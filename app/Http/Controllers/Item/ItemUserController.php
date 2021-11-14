<?php

declare(strict_types=1);

namespace App\Http\Controllers\Item;

use App\Http\Requests\DeleteRequest;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Repository\Eloquent\ItemRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\GalleryRepository;
use App\Http\Controllers\Controller;

class ItemUserController extends Controller
{
    private ItemRepository $itemRepository;
    private GalleryRepository $galleryRepository;
    private CategoryRepository $categoryRepository;
    private UserRepository $userRepository;

    public function __construct(ItemRepository $itemRepository, GalleryRepository $galleryRepository, CategoryRepository $categoryRepository, UserRepository $userRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->galleryRepository = $galleryRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
    }

    public function list(): View
    {
        $list = $this->itemRepository->userItems(Auth::id(), config('sopicms.paginate'));

        return View('main.items.user.list', [
            'title' => config('sopicms.item.userList'),
            'list' => $list,
            'gallery' => $this->galleryRepository->coverList('items', $list->pluck('id')->toArray()),
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
            'gallery' => $this->galleryRepository->list('items', $id)->toArray(),
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

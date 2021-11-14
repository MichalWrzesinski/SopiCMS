<?php

declare(strict_types=1);

namespace App\Http\Controllers\Item;

use App\Http\Requests\DeleteRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\Eloquent\ItemRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\GalleryRepository;
use App\Http\Controllers\Controller;

class ItemController extends Controller
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

    public function list(string $search = null): View
    {
        $search = $this->itemRepository->slugDecode($search);
        $list = $this->itemRepository->list($search, config('sopicms.paginate'));

        return View('main.items.list', [
            'title' => config('sopicms.item.list'),
            'list' => $list,
            'gallery' => $this->galleryRepository->coverList('items', $list->pluck('id')->toArray()),
            'category' => $this->categoryRepository->list(),
            'search' => $search,
        ]);
    }

    public function search(Request $request)
    {
        if($request['price-from'] <> '') {
            $request['price-from'] = convertToNumber($request['price-from']);
        }

        if($request['price-to'] <> '') {
            $request['price-to'] = convertToNumber($request['price-to']);
        }

        $request->validate([
            'query' => ['nullable', 'string'],
            'category' => ['nullable', 'integer'],
            'region' => ['nullable', 'integer'],
            'city' => ['nullable', 'string'],
            'price-from' => ['nullable', 'numeric', 'min:0'],
            'price-to' => ['nullable', 'numeric', 'min:0'],
        ]);

        return redirect()->route('item.list', ['search' => $this->itemRepository->slugEncode($request)]);
    }

    public function show(Int $id, String $url): View
    {
        $item = $this->itemRepository->get($id);

        $cat = $this->categoryRepository->get($item->category_id);
        $item['category'] = $cat->name;
        $item['category_dir'] = '';
        $item['category_parent'] = '';
        if($cat->parent_id > 0) {
            $item['category_dir'] = $cat->parent.' - '.$item['category'];
            $item['category_parent'] = $cat->parent;
        }

        $user = $this->userRepository->get($item->user_id);
        $item['user'] = $user->name;
        $item['email'] = $user->email;
        $item['phone'] = $user->phone;

        return View('main.items.show', [
            'title' => $item->title,
            'item' => $item,
            'gallery' => $this->galleryRepository->list('items', $id)->toArray(),
        ]);
    }

    public function deleteSend(DeleteRequest $request, int $id)
    {
        $this->itemRepository->delete($id);

        return redirect()->route('item.user.list')
            ->with('success', 'Wpis został usunięty');
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\ItemRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\Http\Controllers\Controller;

class ItemController extends Controller
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

    public function list(Request $request, Int $id = 0): View
    {
        if($id > 0 && !($request['category'] > 0)) {
            $request['category'] = $id;
        }

        $search = [
            'query' => $request['query'],
            'category' => $request['category'],
            'region' => $request['region'],
            'city' => $request['city'],
            'price-from' => $request['price-from'],
            'price-to' => $request['price-to'],
        ];

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

        return View('main.items.list', [
            'title' => config('sopicms.item.list'),
            'list' => $this->itemRepository->list($request, config('sopicms.paginate')),
            'category' => $this->categoryRepository->list(),
            'search' => $search,
        ]);
    }

    public function show(Int $id, String $url): View
    {
        $item = $this->itemRepository->get($id);

        $cat = $this->categoryRepository->get($item->category_id);
        $item['category'] = $cat->name;
        if($cat->parent_id > 0) {
            $item['category'] = $cat->parent.' - '.$item['category'];
        }

        $user = $this->userRepository->get($item->user_id);
        $item['user'] = $user->name;
        $item['email'] = $user->email;
        $item['phone'] = $user->phone;

        return View('main.items.show', [
            'title' => $item->title,
            'item' => $item,
        ]);
    }
}

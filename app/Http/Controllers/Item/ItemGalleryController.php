<?php

declare(strict_types=1);

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\ItemRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\Http\Controllers\Controller;

class ItemGalleryController extends Controller
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

    public function addSend(Request $request, int $id)
    {
        $request->validate([
            'file' => ['required', 'file', 'image', 'mimes:jpg,jpeg,gif,png,bmp', 'max:10240'],
        ]);

        $file = $request->file('file')->store('items', 'public');
        $this->itemRepository->imageAdd($id, $file, (auth()->user()->type == 9) ? 0 : Auth::id());

        return back()->with('success', 'Zdjęcie zostało dodane do galerii');
    }

    public function deleteSend(Request $request, int $id, int $key)
    {
        $this->itemRepository->imageDelete($id, $key, (auth()->user()->type == 9) ? 0 : Auth::id());

        return back()->with('success', 'Zdjęcie zostało usunięte z galerii');
    }

    public function coverSend(Request $request, int $id, int $key)
    {
        $this->itemRepository->imageCover($id, $key, (auth()->user()->type == 9) ? 0 : Auth::id());

        return back()->with('success', 'Zdjęcie zostało umstawione jako główne');
    }
}

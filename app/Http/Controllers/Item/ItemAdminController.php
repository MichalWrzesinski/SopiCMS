<?php

declare(strict_types=1);

namespace App\Http\Controllers\Item;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\Eloquent\ItemRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\UserRepository;
use App\Http\Controllers\Controller;

class ItemAdminController extends Controller
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

    public function list(Request $request, $status = null): View
    {
        if($status !== null) {
            $request['status'] = $status;
        }

        return View('admin.items.list', [
            'title' => config('sopicms.item.name'),
            'list' => $this->itemRepository->list($request, config('sopicms.paginate')),
        ]);
    }

    public function listDeactive(Request $request)
    {
        return $this->list($request, 0);
    }

    public function edit(Int $id): View
    {
        return View('admin.items.edit', [
            'title' => config('sopicms.item.edit'),
            'id' => $id,
            'item' => $this->itemRepository->get($id),
            'list' => $this->categoryRepository->list(),
        ]);
    }

    public function editSend(Request $request, Int $id)
    {
        $request->validate([
            'title' => ['required', 'min:10'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'integer'],
            'region' => ['required', 'integer'],
            'city' => ['required', 'min:5'],
            'content' => ['required', 'min:100'],
        ]);

        $this->itemRepository->update($id, $request);

        return back()->with('success', 'Zmiany zostały zapisane.');
    }

    public function publicSend(Request $request, Int $id)
    {
        $this->itemRepository->public($id, $request);

        return back()->with('success', 'Zmiany zostały zapisane.');
    }

    public function gallerySend(Request $request, int $id)
    {
        $request->validate([
            'file' => ['required', 'file', 'image', 'mimes:jpg,jpeg,gif,png,bmp', 'max:10240'],
        ]);

        $file = $request->file('file')->store('items', 'public');
        $this->itemRepository->imageAdd($id, $file);

        return back()->with('success', 'Zdjęcie zostało dodane do galerii2');
    }

    public function settings(): View
    {
        return View('admin.items.settings', [
            'title' => 'Ustawienia',
            'form' => [
                'validity' => config('settings.item.validity'),
                'premium-validity' => config('settings.item.premium.validity'),
                'premium-price' => numberFormat(config('settings.item.premium.price')),
            ],
        ]);
    }

    public function settingsSend(Request $request)
    {
        $request['premium-price'] = convertToNumber($request['premium-price']);

        $request->validate([
            'validity' => ['required', 'integer', 'min:0'],
            'premium-validity' => ['required', 'integer', 'min:0'],
            'premium-price' => ['required', 'numeric', 'min:0'],
        ]);

        Setting::where('key', 'item.validity')->update(['value' => $request['validity']]);
        Setting::where('key', 'item.premium.validity')->update(['value' => $request['premium-validity']]);
        Setting::where('key', 'item.premium.price')->update(['value' => $request['premium-price']]);

        return back()->with('success', 'Ustawienia zostały zapisane');
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Item;

use App\Http\Requests\DeleteRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\ItemRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\Eloquent\ItemRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\GalleryRepository;
use App\Http\Controllers\Controller;

class ItemAdminController extends Controller
{
    private ItemRepository $itemRepository;
    private CategoryRepository $categoryRepository;
    private GalleryRepository $galleryRepository;

    public function __construct(ItemRepository $itemRepository, CategoryRepository $categoryRepository, GalleryRepository $galleryRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->categoryRepository = $categoryRepository;
        $this->galleryRepository = $galleryRepository;
    }

    public function list(Request $request, $status = null): View
    {
        if($status !== null) {
            $request['status'] = $status;
        }

        return View('admin.items.list', [
            'title' => __('items.header.title'),
            'list' => $this->itemRepository->list($request, config('sopicms.paginate')),
        ]);
    }

    public function listDeactive(Request $request)
    {
        return $this->list($request, 0);
    }

    public function edit(int $id): View
    {
        return View('admin.items.edit', [
            'title' => __('items.header.edit'),
            'id' => $id,
            'item' => $this->itemRepository->get($id),
            'list' => $this->categoryRepository->list(),
            'gallery' => $this->galleryRepository->list('items', $id)->toArray(),
        ]);
    }

    public function editSend(ItemRequest $request, int $id)
    {
        $this->itemRepository->update($id, $request);

        return back()->with('success', __('items.alert.done'));
    }

    public function publicSend(Request $request, int $id)
    {
        $this->itemRepository->public($id, $request);
        return back()->with('success', __('items.alert.done'));
    }

    public function gallerySend(ImageRequest $request, int $id)
    {
        $file = $request->file('image')->store('items', 'public');
        $this->itemRepository->imageAdd($id, $file);
        return back()->with('success', __('gallery.alert.add'));
    }

    public function settings(): View
    {
        return View('admin.items.settings', [
            'title' => __('settings.header.title'),
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

        return back()->with('success', __('items.alert.done'));
    }

    public function deleteSend(DeleteRequest $request, int $id)
    {
        $this->itemRepository->delete($id);

        return redirect()->route('admin.items.list')
            ->with('success', __('items.alert.deleted'));
    }
}

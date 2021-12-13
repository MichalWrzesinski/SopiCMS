<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Repository\Eloquent\GalleryRepository;

class GalleryController extends Controller
{
    private GalleryRepository $galleryRepository;

    public function __construct(GalleryRepository $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }

    public function list(string $module, int $moduleId)
    {
        if(!$this->checkAccess($module, $moduleId)) {
            return false;
        }

        return $this->galleryRepository->list($module, $moduleId);
    }

    public function addSend(string $module, int $moduleId, ImageRequest $request)
    {
        if(!$this->checkAccess($module, $moduleId)) {
            return false;
        }

        $image = $request->file('image')->store($module, 'public');
        $this->galleryRepository->add($module, $moduleId, $image);
        return back()->with('success', __('gallery.alert.add'));
    }

    public function coverSend(string $module, int $moduleId, int $id)
    {
        if(!$this->checkAccess($module, $moduleId)) {
            return false;
        }

        $this->galleryRepository->cover($module, $moduleId, $id);
        return back()->with('success', __('gallery.alert.cover'));
    }

    public function deleteSend(int $id)
    {
        if(!$this->checkAccessById($id)) {
            return false;
        }

        $this->galleryRepository->delete($id);
        return back()->with('success', __('gallery.alert.delete'));
    }

    private function checkAccess(string $module, int $moduleId)
    {
        if(auth()->user()->type == 9) {
            return true;
        }

        if($this->galleryRepository
                ->where('module', $module)
                ->where('module_id', $moduleId)
                ->where('user_id', auth()->user()->id)
                ->count() == 1
        ) {
            return true;
        }

        return false;
    }

    private function checkAccessById(int $id)
    {
        if(auth()->user()->type == 9) {
            return true;
        }

        if($this->galleryRepository
                ->where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->count() == 1
        ) {
            return true;
        }

        return false;
    }
}

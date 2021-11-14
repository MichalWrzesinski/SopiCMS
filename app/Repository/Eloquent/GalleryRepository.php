<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Gallery;
use App\Repository\GalleryRepository as GalleryRepositoryInterface;

class GalleryRepository implements GalleryRepositoryInterface
{
    private $model;

    public function __construct(Gallery $model)
    {
        $this->model = $model;
    }

    public function coverList(string $module, array $moduleId)
    {
        $list = $this->model
            ->where('module', $module)
            ->whereIn('module_id', $moduleId)
            ->where('cover', 1)
            ->get()
            ->toArray();

        $sortList = [];
        foreach($moduleId as $value) {
            $sortList[$value] = null;
        }

        foreach($list as $value) {
            $sortList[$value['module_id']] = $value['image'];
        }

        return $sortList;
    }

    public function list(string $module, int $moduleId)
    {
        return $this->model->where('module', $module)
            ->where('module_id', $moduleId)
            ->orderByDesc('cover')
            ->get();
    }

    public function add(string $module, int $moduleId, string $image)
    {
        $cover = 0;
        if($this->model->where('module', $module)->where('module_id', $moduleId)->where('cover', 1)->count() == 0) {
            $cover = 1;
        }

        return $this->model->create([
            'module' => $module,
            'module_id' => $moduleId,
            'image' => $image,
            'cover' => $cover,
        ]);
    }

    public function cover(string $module, int $moduleId,int $id)
    {
        $current = $this->model
            ->where('module', $module)
            ->where('module_id', $moduleId)
            ->where('cover', 1);

        if($current) {
            $current->update([
                'cover' => 0,
            ]);
        }

        return $this->model->find($id)->update([
                'cover' => 1,
            ]);
    }

    public function delete(int $id)
    {
        $row = $this->model->find($id);

        if($row->cover == 1) {
            $next = $this->model->where('module', $row->module)
                ->where('module_id', $row->module_id)
                ->where('cover', 0)
                ->first();

            if($next) {
                $next->update([
                    'cover' => 1,
                ]);
            }
        }

        return $this->model->find($id)->delete();
    }
}

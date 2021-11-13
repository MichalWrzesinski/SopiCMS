<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Repository\CategoryRepository as CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    private Category $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function get(int $id)
    {
        $category = $this->model->findOrFail($id);

        if($category->parent_id > 0) {
            $category->parent = $this->model->findOrFail($category->parent_id)->name;
        }

        return $category;
    }

    public function list()
    {
        $categoryArray = Category::all()->toArray();
        $sortedCategoryArray = [];

        if(isset($categoryArray) && is_array($categoryArray)) {
            foreach($categoryArray as $key => $value) {
                $sortedCategoryArray[$value['parent_id']][$value['y']] = $value;
                $sortedCategoryArray[$value['parent_id']][$value['y']]['lastY'] = $this->lastY($value['parent_id']);
            }
        }

        if(isset($sortedCategoryArray[0]) && is_array($sortedCategoryArray[0])) {
            ksort($sortedCategoryArray[0]);
            foreach($sortedCategoryArray[0] as $value) {
                if(isset($sortedCategoryArray[$value['id']]) && is_array($sortedCategoryArray[$value['id']])) {
                    ksort($sortedCategoryArray[$value['id']]);
                }
            }
        }

        return $sortedCategoryArray;
    }

    public function add($data)
    {
        $this->model->create([
            'parent_id' => (int)$data['parent'],
            'y' => ($this->lastY((int)$data['parent'])+1),
            'name' => $data['name'],
        ]);
    }

    public function update(int $id, $data)
    {
        $cat = $this->model->findOrFail($id)->toArray();

        $y = $cat['y'];
        if($data['parent'] <> $cat['parent_id']) {

            $y = ($this->lastY((int)$data['parent'])+1);

            $this->model->where('parent_id', $cat['parent_id'])
                ->where('y', '>', $cat['y'])
                ->update([
                    'y' => DB::raw('y-1'),
                ]);
        }

        $this->model->findOrFail($id)->update([
            'parent_id' => (int)$data['parent'],
            'y' => $y,
            'name' => $data['name'],
        ]);

        return true;
    }

    public function delete(int $id)
    {
        $cat = $this->model->findOrFail($id);
        $cat->delete();

        $this->model->where('parent_id', $cat['id'])->delete();

        $this->model->where('parent_id', $cat['parent_id'])
            ->where('y', '>', $cat['y'])
            ->update([
                'y' => DB::raw('y-1'),
            ]);

        return true;
    }

    public function up(int $id)
    {
        $selectCategory = $this->model->findOrFail($id);
        if($selectCategory->y <= 0) {
            return false;
        }

        $this->model->where('parent_id', $selectCategory->parent_id)
            ->where('y', ($selectCategory->y-1))
            ->update([
                'y' => $selectCategory->y
            ]);

        $selectCategory->update([
            'y' => ($selectCategory->y-1)
        ]);

        return true;
    }

    public function down(int $id)
    {
        $selectCategory = $this->model->findOrFail($id);

        if($selectCategory->y >= $this->lastY($selectCategory['parent_id'])) {
            return false;
        }

        $this->model->where('parent_id', $selectCategory->parent_id)
            ->where('y', ($selectCategory->y+1))
            ->update([
                'y' => $selectCategory->y
            ]);

        $selectCategory->update([
            'y' => ($selectCategory->y+1)
        ]);

        return true;
    }

    public function lastY(int $parent_id): int
    {
        $lastY = $this->model->select(['y'])
            ->where('parent_id', $parent_id)
            ->orderByDesc('y')
            ->take(1)
            ->get()
            ->toArray();

        return ((isset($lastY[0]['y'])) ? $lastY[0]['y'] : (-1));
    }

    public function parentList()
    {
        return $this->model->where('parent_id', 0)->get()->toArray();
    }
}

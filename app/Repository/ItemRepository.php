<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Category;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ItemRepository
{
    private Item $model;

    public function __construct(Item $model)
    {
        $this->model = $model;
    }

    public function get(int $id, int $userId = 0)
    {
        return $this->fill($this->getData($id, $userId));
    }

    private function getData(int $id, int $userId = 0)
    {
        if($userId > 0) {
            return $this->model
                ->where('id', $id)
                ->where('user_id', $userId)
                ->firstOrFail();
        }

        return $this->model->findOrFail($id);
    }

    public function list($search = [], $limit = null, $order = 'title', $direction = 'ASC')
    {
        $catList = [];

        if(isset($search['category'])) {
            $catList = [(int)$search['category']];

            if($search['category'] > 0) {
                $cat = Category::find($search['category']);
                if($cat->parent_id == 0) {
                    foreach(Category::select('id')->where('parent_id', $cat->id)->get()->toArray() as $value) {
                        $catList[] = $value['id'];
                    }
                }
            }
        }

        $list = $this->model->where(function($query) use($search, $catList) {
            if(isset($search['status']) && $search['status'] !== null) $query->where('status', $search['status']);
            if(isset($search['id']) && $search['id'] == 1 && (int)$search['search'] > 0) $query->orWhere('id', (int)$search['search']);
            if(isset($search['title']) && $search['title'] == 1) $query->orWhere('title', 'like', '%'.$search['search'].'%');
            if(isset($search['content']) && $search['content'] == 1) $query->orWhere('content', 'like', '%'.$search['search'].'%');

            if(!empty($search['query'])) $query->where('title', 'like', '%'.$search['query'].'%');
            if(!empty($search['category'])) $query->whereIn('category_id', $catList);
            if(!empty($search['region'])) $query->where('region', $search['region']);
            if(!empty($search['city'])) $query->where('city', 'like', '%'.$search['city'].'%');
            if(!empty($search['price-from'])) $query->where('price', '>=', $search['price-from']);
            if(!empty($search['price-to'])) $query->where('price', '<=', $search['price-to']);
        })->orderBy($order, $direction);

        if($limit > 0) {
            return $this->fillCollection($list->paginate($limit));
        }

        return $this->fillCollection($list->get());
    }

    public function add($data)
    {
        return $this->model->create([
            'status' => 0,
            'user_id' => Auth::id(),
            'category_id' => $data['category'],
            'validity' => Carbon::now()->addDays(config('settings.item.validity')),
            'title' => $data['title'],
            'price' => $data['price'],
            'region' => $data['region'],
            'city' => $data['city'],
            'content' => $data['content'],
        ])->id;
    }

    public function update(int $id, $data, int $userId = 0)
    {
        return $this->getData($id, $userId)->update([
            'category_id' => $data['category'],
            'title' => $data['title'],
            'price' => $data['price'],
            'region' => $data['region'],
            'city' => $data['city'],
            'content' => $data['content'],
        ]);
    }

    public function public(int $id, $data)
    {
        return $this->model->findOrFail($id)->update([
            'status' => $data['status'],
            'validity' => $data['validity'],
            'premium' => $data['premium'],
        ]);
    }

    public function delete(int $id, int $userId = 0)
    {
        return $this->getData($id, $userId)->delete();
    }

    public function userItems(int $userId, $limit = null, $order = 'created_at')
    {
        $list = $this->model
            ->where('user_id', $userId)
            ->orderByDesc($order);

        if($limit > 0) {
            return $this->fillCollection($list->paginate($limit));
        }

        return $this->fillCollection($list->get());
    }

    public function imageAdd(int $id, string $file, int $userId = 0)
    {
        $item = $this->getData($id, $userId);
        $item->gallery = (($item->gallery <> '') ? $item->gallery.';' : '').$file;
        $item->save();

        return true;
    }

    public function imageDelete(int $id, int $key, int $userId = 0)
    {
        $item = $this->getData($id, $userId);
        $gallery = explode(';', $item->gallery);
        unset($gallery[$key]);
        $item->gallery = implode(';', $gallery);
        $item->save();

        return true;
    }

    public function imageCover(int $id, int $key, int $userId = 0)
    {
        $item = $this->getData($id, $userId);
        $gallery = explode(';', $item->gallery);
        $img = $gallery[$key];
        unset($gallery[$key]);
        array_unshift($gallery, $img);
        $item->gallery = implode(';', $gallery);
        $item->save();

        return true;
    }

    private function fill($row)
    {
        $row->gallery = ($row->gallery <> '') ? explode(';', $row->gallery) : '';
        $row->url = route('item.show', ['id' => $row->id, 'url' => Str::Slug($row->title)]);
        $row->description = mb_substr($row->content, 0, 100, 'UTF-8');

        return $row;
    }

    private function fillCollection($list)
    {
        foreach($list as $row) {
            $row = $this->fill($row);
        }

        return $list;
    }
}

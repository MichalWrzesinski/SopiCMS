<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Repository\ItemRepository as ItemRepositoryInterface;

class ItemRepository implements ItemRepositoryInterface
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
            if(!empty($search['region'])) $query->where('region', (int)$search['region']);
            if(!empty($search['city'])) $query->where('city', 'like', '%'.$search['city'].'%');
            if(!empty($search['price-from'])) $query->where('price', '>=', (float)$search['price-from']);
            if(!empty($search['price-to'])) $query->where('price', '<=', (float)$search['price-to']);
            if(!empty($search['user'])) $query->where('user_id', (int)$search['user']);
        })->orderBy($order, $direction);

        if($limit > 0) {
            return $this->fillCollection($list->paginate($limit));
        }

        return $this->fillCollection($list->get());
    }

    public function slugEncode($data)
    {
        $slug = [];

        if(!empty($data['category'])) {
            $slug[] = config('sopicms.opd.category');
            $slug[] = $data['category'];
        }
        if(!empty($data['region'])) {
            $slug[] = config('sopicms.opd.region');
            $slug[] = $data['region'];
        }
        if(!empty($data['city'])) {
            $slug[] = config('sopicms.opd.city');
            $slug[] = urlencode($data['city']);
        }
        if(!empty($data['price-from'])) {
            $slug[] = config('sopicms.opd.price-from');
            $slug[] = $data['price-from'];
        }
        if(!empty($data['price-to'])) {
            $slug[] = config('sopicms.opd.price-to');
            $slug[] = $data['price-to'];
        }
        if(!empty($data['query'])) {
            $slug[] = config('sopicms.opd.query');
            $slug[] = urlencode($data['query']);
        }
        if(!empty($data['user'])) {
            $slug[] = config('sopicms.opd.user');
            $slug[] = $data['user'];
        }

        return implode('/', $slug);
    }

    public function slugDecode($data)
    {
        $search = [];

        $opd = array_flip(config('sopicms.opd'));

        if($data <> '') {
            $searchArray = explode('/', $data);
            foreach($searchArray as $key => $value) {
                if($key % 2 == 0) {
                    $label = $value;
                    if(isset($opd[$value])) {
                        $label = $opd[$value];
                    }
                    $search[$label] = $searchArray[$key+1];
                }
            }
        }

        return $search;
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

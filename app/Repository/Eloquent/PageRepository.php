<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Page;
use Illuminate\Support\Str;
use App\Repository\PageRepository as PageRepositoryInterface;

class PageRepository implements PageRepositoryInterface
{
    private $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    public function get(int $id)
    {
        return $this->fill($this->model->findOrFail($id));
    }

    public function getByUrl(string $url)
    {
        return $this->fill($this->model->where('url', $url)->firstOrFail());
    }

    public function list($search = [], $limit = null, $order = 'title', $direction = 'ASC')
    {
        $list = $this->model->where(function($query) use($search) {
            if(isset($search['id']) && $search['id'] == 1 && (int)$search['search'] > 0) $query->orWhere('id', (int)$search['search']);
            if(isset($search['title']) && $search['title'] == 1) $query->orWhere('title', 'like', '%'.$search['search'].'%');
            if(isset($search['url']) && $search['url'] == 1) $query->orWhere('url', 'like', '%'.$search['search'].'%');
            if(isset($search['content']) && $search['content'] == 1) $query->orWhere('content', 'like', '%'.$search['search'].'%');
        })->orderBy($order, $direction);

        if($limit > 0) {
            return $this->fillCollection($list->paginate($limit));
        }

        return $this->fillCollection($list->get());
    }

    public function add($data)
    {
        return $this->model->create([
            'url' => Str::slug($data['title']),
            'title' => $data['title'],
            'content' => $data['content'],
        ])->id;
    }

    public function update(int $id, $data)
    {
        return $this->model->findOrFail($id)->update([
            'title' => $data['title'],
            'url' => $data['url'],
            'description' => $data['description'],
            'keywords' => $data['keywords'],
            'content' => $data['content'],
        ]);
    }

    public function delete(int $id)
    {
        return $this->model->findOrFail($id)
            ->where('constant', 0)
            ->delete();
    }

    private function fill($row)
    {
        $row->gallery = ($row->gallery <> '') ? explode(';', $row->gallery) : '';

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

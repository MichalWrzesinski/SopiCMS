<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Blog;
use Illuminate\Support\Str;
use App\Repository\BlogRepository as BlogRepositoryInterface;

class BlogRepository implements BlogRepositoryInterface
{
    private $model;

    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    public function get(int $id)
    {
        return $this->fill($this->model->findOrFail($id));
    }

    public function list($search = [], $limit = null, $order = 'created_at', $direction = 'DESC')
    {
        $list = $this->model->where(function($query) use($search) {
            if(isset($search['id']) && $search['id'] == 1 && (int)$search['search'] > 0) $query->orWhere('id', (int)$search['search']);
            if(isset($search['title']) && $search['title'] == 1) $query->orWhere('title', 'like', '%'.$search['search'].'%');
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
            'title' => $data['title'],
            'content' => $data['content'],
        ])->id;
    }

    public function update(int $id, $data)
    {
        return $this->model->findOrFail($id)->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'keywords' => $data['keywords'],
            'content' => $data['content'],
        ]);
    }

    public function delete(int $id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    private function fill($row)
    {
        $row->gallery = ($row->gallery <> '') ? explode(';', $row->gallery) : '';
        $row->url = route('blog.show', ['id' => $row->id, 'url' => Str::slug($row->title)]);

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

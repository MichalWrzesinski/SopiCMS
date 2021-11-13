<?php

declare(strict_types=1);

namespace App\Repository;

interface ItemRepository
{
    public function get(int $id, int $userId = 0);
    public function list($search = [], $limit = null, $order = 'title', $direction = 'ASC');
    public function add($data);
    public function update(int $id, $data, int $userId = 0);
    public function public(int $id, $data);
    public function delete(int $id, int $userId = 0);
    public function userItems(int $userId, $limit = null, $order = 'created_at');
    public function imageAdd(int $id, string $file, int $userId = 0);
    public function imageDelete(int $id, int $key, int $userId = 0);
    public function imageCover(int $id, int $key, int $userId = 0);
}


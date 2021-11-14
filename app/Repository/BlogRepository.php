<?php

declare(strict_types=1);

namespace App\Repository;

interface BlogRepository
{
    public function get(int $id);
    public function list($search = [], $limit = null, $order = 'created_at', $direction = 'DESC');
    public function add($data);
    public function update(int $id, $data);
    public function delete(int $id);
}

<?php

declare(strict_types=1);

namespace App\Repository;

interface PageRepository
{
    public function get(int $id);
    public function getByUrl(string $url);
    public function list($search = [], $limit = null, $order = 'title', $direction = 'ASC');
    public function add($data);
    public function update(int $id, $data);
    public function delete(int $id);
}

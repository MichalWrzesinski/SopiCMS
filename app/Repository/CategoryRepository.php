<?php

declare(strict_types=1);

namespace App\Repository;

interface CategoryRepository
{
    public function get(int $id);
    public function list();
    public function add($data);
    public function update(int $id, $data);
    public function delete(int $id);
    public function up(int $id);
    public function down(int $id);
    public function lastY(int $parent_id): int;
    public function parentList();
}

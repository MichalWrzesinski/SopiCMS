<?php

declare(strict_types=1);

namespace App\Repository;

interface GalleryRepository
{
    public function coverList(string $module, array $moduleId);
    public function list(string $module, int $moduleId);
    public function add(string $module, int $moduleId, string $image);
    public function cover(string $module, int $moduleId, int $id);
    public function delete(int $id);
}

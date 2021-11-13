<?php

declare(strict_types=1);

namespace App\Repository;

interface UserRepository
{
    public function get(int $id);
    public function list($search = [], $limit = null, $order = 'name', $direction = 'ASC');
    public function update(int $id, $data);
    public function delete(int $id);
    public function login($data);
    public function add($data);
    public function active(int $id, string $hash);
    public function logout();
    public function passwordInit($data);
    public function passwordVeryfi(int $id, string $hash);
    public function passwordReset(int $id, $data);
    public function newsletter(string $title, string $content);
}

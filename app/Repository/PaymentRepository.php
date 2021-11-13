<?php

declare(strict_types=1);

namespace App\Repository;

interface PaymentRepository
{
    public function get(int $id);
    public function list($limit = null, $order = 'created_at', $direction = 'DESC');
}

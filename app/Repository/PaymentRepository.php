<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Payment;

class PaymentRepository
{
    private $model;

    public function __construct(Payment $model)
    {
        $this->model = $model;
    }

    public function get(int $id)
    {
        return $this->fill($this->model->findOrFail($id));
    }

    public function list($limit = null, $order = 'created_at', $direction = 'DESC')
    {
        $list = $this->model->select(['payments.*', 'users.name'])
            ->leftJoin('users', function($query) {
                $query->on('payments.user_id', '=', 'users.id');
            })
            ->orderBy('payments.'.$order, $direction);

        if($limit > 0) {
            return $list->paginate($limit);
        }

        return $list->get();
    }
}

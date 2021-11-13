<?php

namespace App\Http\Controllers\Payment;

use App\Repository\PEloquent\aymentRepository;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    private PaymentRepository $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }


}

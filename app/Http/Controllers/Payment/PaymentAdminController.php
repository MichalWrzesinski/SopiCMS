<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\Eloquent\PaymentRepository;
use App\Http\Controllers\Controller;

class PaymentAdminController extends Controller
{
    private PaymentRepository $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function list(Request $request): View
    {
        return View('admin.payments.list', [
            'title' => __('payments.header.title'),
            'list' => $this->paymentRepository->list(config('sopicms.paginate')),
        ]);
    }
}

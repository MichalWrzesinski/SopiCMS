<?php

namespace App\Http\Controllers\Payment;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository\PaymentRepository;
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
            'title' => 'Pałtności',
            'list' => $this->paymentRepository->list(config('sopicms.paginate')),
        ]);
    }
}

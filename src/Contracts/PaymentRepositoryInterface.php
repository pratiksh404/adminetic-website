<?php

namespace Adminetic\Website\Contracts;

use Adminetic\Website\Http\Requests\PaymentRequest;
use Adminetic\Website\Models\Admin\Payment;

interface PaymentRepositoryInterface
{
    public function indexPayment();

    public function createPayment();

    public function storePayment(PaymentRequest $request);

    public function showPayment(Payment $Payment);

    public function editPayment(Payment $Payment);

    public function updatePayment(PaymentRequest $request, Payment $Payment);

    public function destroyPayment(Payment $Payment);
}

<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Contracts\PaymentRepositoryInterface;
use Adminetic\Website\Http\Requests\PaymentRequest;
use Adminetic\Website\Models\Admin\Payment;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    protected $paymentRepositoryInterface;

    public function __construct(PaymentRepositoryInterface $paymentRepositoryInterface)
    {
        $this->paymentRepositoryInterface = $paymentRepositoryInterface;
        $this->authorizeResource(Payment::class, 'payment');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.payment.index', $this->paymentRepositoryInterface->indexPayment());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\PaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $this->paymentRepositoryInterface->storePayment($request);

        return redirect(adminRedirectRoute('payment'))->withSuccess('Payment Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return view('website::admin.payment.show', $this->paymentRepositoryInterface->showPayment($payment));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('website::admin.payment.edit', $this->paymentRepositoryInterface->editPayment($payment));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\PaymentRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, Payment $payment)
    {
        $this->paymentRepositoryInterface->updatePayment($request, $payment);

        return redirect(adminRedirectRoute('payment'))->withInfo('Payment Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $this->paymentRepositoryInterface->destroyPayment($payment);

        return redirect(adminRedirectRoute('payment'))->withFail('Payment Deleted Successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use Flutterwave\Util\Currency;
use Flutterwave\Flutterwave;

\Flutterwave\Flutterwave::bootstrap();

use App\Models\Payment;
use App\Models\Customer;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Requests\PaymentRequest;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Services\HttpCaller;

use App\Http\Resources\Payment\PaymentCollection;
use App\Http\Resources\Payment\PaymentResource;

use App\Services\PaymentService;
use App\Services\CustomerService;

class PaymentController extends Controller
{
    public $http_caller;
    public $payment_service;
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HttpCaller $http_caller, PaymentService $payment_service)
    {
        $this->http_caller = $http_caller;
        $this->payment_service = $payment_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer)
    {
        return PaymentResource::collection($customer->payments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request, $payment)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request, $customer)
    {
       $payment = $this->payment_service->chargeCard($request->toArray(), $customer);
        return response([
            'status' => true,
            'data' => new PaymentResource($payment)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($customer,$payment)
    {
        $customer=Customer::find($customer);
        $payment=Payment::find($payment);
        if (!$customer){
            throw new CustomException(false,'Customer Details not found',Response::HTTP_NOT_FOUND);
        }else{
            if (!$payment){
                throw new CustomException(false,'Customer Payment Details not found',Response::HTTP_NOT_FOUND);
            }
        }
        

        return response([
            'status' => true,
            'data' => new PaymentResource($payment)
        ], Response::HTTP_FOUND);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentRequest  $request
     * @param  \App\Models\Model\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}

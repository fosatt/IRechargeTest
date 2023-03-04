<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Services\CustomerService;
use Exception;
use Illuminate\Support\Facades\Cache;
use App\Models\Payment;
use App\Services\HttpCaller;
use Symfony\Component\HttpFoundation\Response;

class PaymentService
{
    public $customer_service;
    public $http_caller;
    const URL = '/charges?type=card';

    public function __construct(CustomerService $customer_service, HttpCaller $http_caller)
    {
        $this->customer_service = $customer_service;
        $this->http_caller =$http_caller;
    }

    public function chargeCard($request, $customer){
        $customer_response=$this->customer_service->findCustomer($customer);
        $payment=PaymentService::createPayment($request, $customer);

       

                
        $data=[
            "card_number" => strval($request['card_number']),
            "cvv" => strval($request['cvv']),
            "expiry_month" => $request['expiry_month'],
            "expiry_year" => $request['expiry_year'],
            "currency" => "NGN",
            "amount" => $payment->amount,
            "fullname" => $customer_response->fullname,
            "email" => $customer_response->email,
            "tx_ref" => $payment->reference_id,
            "authorization"=>[
                "mode"=>"pin",
                "pin"=>3310
            ],                
        ];
        $response = $this->http_caller->postRequest(PaymentService::URL, $data);
        
        if ($response['data']['status'] === "successful" && $response['data']['amount'] === $payment->amount){
            $payment->update(['status'=>'completed']);
        }else {
            $payment->update(['status' => 'initiated']);
        }

        return $payment;
    }

    public function createPayment($request, $customer_id){
        $payment=new Payment;
        
        $payment->customer_id = $customer_id;
        $payment->amount = $request['amount'];
        $payment->reference_id = time().rand(11111111,99999999);
        $payment->transaction_id = $request['transaction_id'];
        $payment->save();
        return $payment;
    }

    public function findPayment($payment_id){
     
        $payment = Payment::find($payment_id);
        if (!$payment){
            throw new CustomException(false,'Customer Payment Details not found',Response::HTTP_NOT_FOUND);
        }
        
        return ($payment);
    }

}

    
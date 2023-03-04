<?php

namespace App\Services;

use Exception;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Customer;

class CustomerService
{

    public function findCustomer($customer_id){
     
        $customer = Customer::find($customer_id);
        if (!$customer){
            throw new CustomException(false,'Customer Details not found',Response::HTTP_NOT_FOUND);
        }
        
        return ($customer);
    }


    public function createCustomer($request){
        $customer=new Customer;
        $customer->first_name = $request['first_name'];
        $customer->last_name = $request['last_name'];
        $customer->email = $request['email'];
        $customer->phone = $request['phone'];

        $customer->save();
        return $customer;
    }

    
}
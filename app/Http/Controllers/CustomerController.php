<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\CustomerRequest;

use App\Http\Resources\Customer\CustomerCollection;
use App\Http\Resources\Customer\CustomerResource;

use Illuminate\Http\Request;
use App\Services\CustomerService;

use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    public $customer_service;

    public function __construct(CustomerService $customer_service)
    {
        $this->customer_service = $customer_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'status' => true,
            'data' => CustomerResource::collection(Customer::all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = $this->customer_service->createCustomer($request->toArray());

        return response([
            'status' => true,
            'data' => new CustomerResource($customer)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show( $customer)
    {

        $customer = $this->customer_service->findCustomer($customer);

        return response([
            'status' => true,
            'data' => new CustomerResource($customer)
        ], Response::HTTP_FOUND);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Model\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}

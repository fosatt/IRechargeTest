<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_customer()
    {
        $customer = Customer::factory()->create();

        $this->assertTrue(true);

       
        // dd($res['status']);
        // $content = json_decode($res->getContent());
        // $res->assertStatus(201);
        

        // $this->assertEquals(true, ($res['status']));


        
    }

}
